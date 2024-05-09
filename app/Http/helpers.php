<?php
function returnData($status, $data)
{
    return response()->json([
        'status' => $status,
        'data' => $data
    ]);
}
function uploadFile(string $path, $file)
{
    $extension = strtolower($file->getClientOriginalExtension());
    $name = time() . rand(100, 999) . '.' . $extension;
    return $file->move($path, $name);
}

function deleteFile($file)
{
    if (file_exists($file)) {
        unlink($file);
    }
}

function setSidebarActive($route)
{
    if (is_array($route)) {
        foreach ($route as $r) {
            if (request()->routeIs($r)) {
                return 'active';
            }
        }
    }
}
