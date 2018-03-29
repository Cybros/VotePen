<?php

if (! empty($greeting)) {
    echo $greeting, "\n";
} else {
    echo $level == 'error' ? 'Whoops!' : 'Hello!', "\n";
}

if (! empty($introLines)) {
    echo implode("\n", $introLines), "\n";
}

if (isset($actionText)) {
    echo "{$actionText}: {$actionUrl}", "\n";
}

if (! empty($outroLines)) {
    echo implode("\n", $outroLines), "\n";
}

echo 'Regards,', "\n";
echo config('app.name'), "\n";
