<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\Container9JYx06h\srcApp_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/Container9JYx06h/srcApp_KernelDevDebugContainer.php') {
    touch(__DIR__.'/Container9JYx06h.legacy');

    return;
}

if (!\class_exists(srcApp_KernelDevDebugContainer::class, false)) {
    \class_alias(\Container9JYx06h\srcApp_KernelDevDebugContainer::class, srcApp_KernelDevDebugContainer::class, false);
}

return new \Container9JYx06h\srcApp_KernelDevDebugContainer([
    'container.build_hash' => '9JYx06h',
    'container.build_id' => 'ee86b2fb',
    'container.build_time' => 1563049178,
], __DIR__.\DIRECTORY_SEPARATOR.'Container9JYx06h');
