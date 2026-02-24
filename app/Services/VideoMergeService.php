<?php

declare(strict_types=1);

namespace App\Services;

use RuntimeException;

class VideoMergeService
{
    public function merge(array $inputPaths, string $outputPath): void
    {
        $normalizedPaths = [];

        try {
            foreach ($inputPaths as $i => $path) {
                $normalized = sys_get_temp_dir().'/ffmpeg_norm_'.uniqid()."_{$i}.mp4";
                $normalizedPaths[] = $normalized;

                $command = sprintf(
                    'ffmpeg -i %s -c:v libx264 -c:a aac -y %s 2>&1',
                    escapeshellarg($path),
                    escapeshellarg($normalized),
                );

                exec($command, $output, $exitCode);

                if ($exitCode !== 0) {
                    throw new RuntimeException(
                        'FFmpeg normalize failed for file '.($i + 1).': '.implode("\n", array_slice($output, -10)),
                    );
                }
            }

            $listFile = tempnam(sys_get_temp_dir(), 'ffmpeg_list_');
            $lines = array_map(
                fn (string $p) => "file '".str_replace("'", "'\\''", $p)."'",
                $normalizedPaths,
            );
            file_put_contents($listFile, implode("\n", $lines));

            $command = sprintf(
                'ffmpeg -f concat -safe 0 -i %s -c copy -movflags +faststart -y %s 2>&1',
                escapeshellarg($listFile),
                escapeshellarg($outputPath),
            );

            exec($command, $output, $exitCode);
            unlink($listFile);

            if ($exitCode !== 0) {
                throw new RuntimeException(
                    'FFmpeg concat failed: '.implode("\n", array_slice($output, -10)),
                );
            }
        } finally {
            foreach ($normalizedPaths as $path) {
                if (file_exists($path)) {
                    unlink($path);
                }
            }
        }
    }
}
