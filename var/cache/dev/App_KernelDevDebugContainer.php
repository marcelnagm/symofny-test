<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerAvAUriy\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerAvAUriy/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerAvAUriy.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerAvAUriy\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \ContainerAvAUriy\App_KernelDevDebugContainer([
    'container.build_hash' => 'AvAUriy',
    'container.build_id' => '7bf5c58e',
    'container.build_time' => 1636396654,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerAvAUriy');
