<?php

use Illuminate\Support\Str;

/**
 * @param $oldtime
 * @param null $newTime
 * @return string
 */
function elapsed($oldtime, $newTime = null)
{
    if (!$newTime) {
        $newTime = time();
    }
    $time = $newTime - strtotime($oldtime); // to get the time since that moment
    $tokens = [
        31536000 => 'année',
        2592000 => 'mois',
        604800 => 'semaine',
        86400 => 'jour',
        3600 => 'heure',
        60 => 'minute',
        1 => 'seconde'
    ];
    $tabElapsed = [];
    foreach ($tokens as $unit => $text) {
        if ($time < $unit) continue;
        $numberOfUnits = floor($time / $unit);
        if ($text == 'mois') {
            $tabElapsed[$text] = $numberOfUnits . ' ' . $text;
        } else {
            $tabElapsed[$text] = $numberOfUnits . ' ' . $text . (($numberOfUnits > 1) ? 's' : '');
        }
        $time = $time - ($unit * $numberOfUnits);
    }
    return array_values($tabElapsed)[0];
}

/**
 * @param int $length
 * @return string
 */
function generateNewRandomString($length = 10)
{
    $characters = '0123456789ABCDEFGHIJKLM';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

/**
 * @param string $firstName
 * @param string $lastName
 * @param string $folder
 * @param string $color
 * @return string
 */
function generateAvatarByName($firstName, $lastName, $folder = 'profiles', $color = '#FB942F')
{
    $randomStr = generateNewRandomString();
    $img = Image::canvas(100, 100, $color);
    $init = strtoupper($firstName[0] . '' . $lastName[0]);
    $img->text($init, 50, 35, function ($font) {
        $font->file(public_path('font/tsuku/TsukuARdGothic-Bold.ttf'));
        $font->size(40);
        $font->color('#FFFFFF');
        $font->align('center');
        $font->valign('top');
    });

    if (is_dir(public_path($folder) . '/' . $randomStr[0])) {
        if (file_exists(public_path($folder) . '/' . $randomStr[0] . '/' . $randomStr . '.png')) {
            unlink(public_path($folder) . '/' . $randomStr[0] . '/' . $randomStr . '.png');
        }
        $img->save(public_path($folder) . '/' . $randomStr[0] . '/' . $randomStr . '.png', 60);
    } else {
        if (mkdir(public_path($folder) . '/' . $randomStr[0], 0777, true)) {
            $img->save(public_path($folder) . '/' . $randomStr[0] . '/' . $randomStr . '.png', 60);
        }
    }
    $path = '/'.$folder.'/' . $randomStr[0] . '/' . $randomStr . '.png';
    return $path;
}

/**
 * @param \Illuminate\Http\UploadedFile $file
 * @param string $type
 * @param string $customString
 * @param bool $storage
 * @return null|string
 */
function uploadFile(\Illuminate\Http\UploadedFile $file, $type = 'default', $customString = '', $storage = false)
{
    if ($file->isValid()) {
        $uploadAttributes = config("mimetypes.$type");
        $path = config("paths.$type");
        if (Str::contains($path, '%s')) {
            if (!$customString)
                return null;

            $path = str_replace('%s', substr($customString, -1) . '/' . $customString, $path);
        }
        if ($storage) {
            $storagePath = storage_path($path);
        } else {
            $storagePath = $path;
        }

        if (isset($uploadAttributes[$file->getMimeType()])) {
            $name = Str::random(10) . '_' . time() . '.' . $uploadAttributes[$file->getMimeType()];
            if ($file->move($storagePath, $name)) {
                if (isset($uploadAttributes['size'])) {
                    Image::make($storagePath . '/' . $name)->resize((int)$uploadAttributes['size'], null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->orientate()->save($storagePath . '/' . $name);
                }
                return '/' . $path . '/' . $name;
            }
        }
    }
    return null;
}