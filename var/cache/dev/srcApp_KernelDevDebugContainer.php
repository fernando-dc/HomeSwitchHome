<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerZrJHOps\srcApp_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerZrJHOps/srcApp_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerZrJHOps.legacy');

    return;
}

if (!\class_exists(srcApp_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerZrJHOps\srcApp_KernelDevDebugContainer::class, srcApp_KernelDevDebugContainer::class, false);
}

return new \ContainerZrJHOps\srcApp_KernelDevDebugContainer([
    'container.build_hash' => 'ZrJHOps',
    'container.build_id' => 'c055d3d5',
    'container.build_time' => 1563059444,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerZrJHOps');
