<?php
namespace helpers;

use Controllers\BlogController;
use Exception;
use Models\Subscribe;
use Models\User;

function array_get($array, $key, $default = null) {
    $keys = explode('.', $key);

    if (key_exists($keys[0], $array)) {
        try {
            foreach ($keys as $key) {
                $array = $array[$key];
            }
            return $array;
        } catch (Exception $e) {
            return $default;
        }
    } else {
        return $default;
    }
}

function getRandomSVGFill(){
    $output = sprintf ( "%06x" , mt_rand ( 0, 0xffffff ) );
    return $output;
}

function setSelectedFieldDefault($number) {
    if (isset($_GET['show']) && $_GET['show'] === $number) {
        return 'selected';
    } elseif (!isset($_GET['show']) && $number === '20') {
        return 'selected';
    } else {
        return '';
    }
};

function setHrefForAdminPagination($href, $get) {
    if (isset($_GET[$get])) {
        return $href . '?' . $get . '=' . $_GET[$get] . '&';
    } else {
        return $href . '?show=20&';
    }
}

function getAdminPageParseUrl() {
    $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    switch ($url) {
        case '/admin/blogs' :
            return 'Blogs';
            break;
        case '/admin/comments' :
            return 'Comments';
            break;
        case '/admin/users' :
            return 'Users';
            break;
        case '/admin/subscribes' :
            return 'Subscribes';
            break;
        case '/admin/settings' :
            return 'Settings';
            break;
        default : return 'Main';
    }
}

function setActiveAdminNavigation($page) {
    $url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

    if (strrpos($url, $page)) {
        return 'active';
    }
};

function checkModerationGrants() {
    if (isset($_COOKIE['grants']) && ($_COOKIE['grants'] === 'admin' || $_COOKIE['grants'] === 'manager') && (isset($_SESSION['login']) && $_SESSION['login'] === 'yes')) {
        return true;
    } else {
        return false;
    }
};

function checkEditGrants($user) {
    if ((isset($_SESSION['login']) && $_SESSION['login'] === 'yes')) {
        if (isset($_COOKIE['grants']) && ($_COOKIE['grants'] === 'admin' || $_COOKIE['grants'] === 'manager')) {
            return true;
        } elseif (isset($_COOKIE['login']) && ($_COOKIE['login']) === $user->email) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
};

function isAdmin() {
    if (isset($_COOKIE['grants']) && $_COOKIE['grants'] === 'admin') {
        return true;
    } else {
        return false;
    }
}

function isModerator() {
    if (isset($_COOKIE['grants']) && ($_COOKIE['grants'] === 'manager' || $_COOKIE['grants'] === 'admin')) {
        return true;
    } else {
        return false;
    }
}

function isSubscribed($profile, $login) {
    $currentUser = User::where('email', $login)->first();
    $subscribe = Subscribe::where('subscriber', $currentUser->id)->where('subscribe_to', $profile->id)->first();

    if ($currentUser->id === $profile->id) {
        return 'SELF';
    } else if ($subscribe) {
        return 'YES';
    } else {
        return 'NO';
    }
}

function checkLoadFileType($itemTmpPath) {
    $correctFilesTypes = ['image/png', 'image/jpeg', 'image/jpg'];
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $fileType = finfo_file($finfo, $itemTmpPath);

    if (in_array($fileType, $correctFilesTypes)) {
        return true;
    }
    else return false;
}

function loadPhoto($imgPath, $model, $defaultModelImage)
{
    function loadPhotoToServer($path) {
        $errorMessages = [
            UPLOAD_ERR_INI_SIZE => 'Размер файла превысил значение upload_max_filesize в конфигурации PHP.',
            UPLOAD_ERR_FORM_SIZE => 'Размер загружаемого файла превысил значение MAX_FILE_SIZE в HTML-форме.',
            UPLOAD_ERR_PARTIAL => 'Загружаемый файл был получен только частично.',
            UPLOAD_ERR_NO_FILE => 'Файл не был загружен.',
            UPLOAD_ERR_NO_TMP_DIR => 'Отсутствует временная папка.',
            UPLOAD_ERR_CANT_WRITE => 'Не удалось записать файл на диск.',
            UPLOAD_ERR_EXTENSION => 'PHP-расширение остановило загрузку файла.',
        ];
        $unknownMessage = 'При загрузке файла произошла неизвестная ошибка.';

        $error = $_FILES["photo"]['error'];

        if ($error == UPLOAD_ERR_OK) {
            $tmp_name = $_FILES["photo"]["tmp_name"];

            move_uploaded_file($tmp_name, $path);
            return 'Photo added';
        } else {
            $outputMessage = isset($errorMessages[$error]) ? $errorMessages[$error] : $unknownMessage;
            return $outputMessage;
        }
    }

    if (!empty($_FILES) && !empty($_FILES['photo']['name'])) {
        $images = scandir($imgPath);

        $tmp_name = $_FILES["photo"]["tmp_name"];

        $size = $_FILES['photo']['size'];

        if (checkLoadFileType($tmp_name) && $size <= 2 * 1024 * 1024) {
            if (in_array($model->photo, $images) && ($model->photo !== $defaultModelImage)) {
                $targetPath = $imgPath . $model->photo;

                if (!unlink($targetPath)) {
                    return 'Delete Old Blog Image Failed';
                }
            }

            $name = explode('.' , $_FILES["photo"]["name"]);
            $name = $name[0] . '_' . $model->id . '.' . $name[1];
            $path = $imgPath . $name;

            $result = loadPhotoToServer($path);

            if ($result !== 'Photo added') {
                return $result;
            } else {
                $model->photo = basename($name);
                return $result;
            }
        } else {
            return 'File type is not supported to load or Photo size > 2Mb. Available only jpg, jpeg, png.';
        }
    } else {
        return 'Photo added';
    }
}

function loadSettingsFromFile($path) {
    return json_decode(file_get_contents($path), true);
}

function saveSettingsToFile($path, $data) {
    file_put_contents($path, json_encode($data));
}

function writeNewBlogLog($filePath, $blog, $subscriber, $readHref, $unsubHref) {
    if (file_exists($filePath)) {
        $file = fopen($filePath, 'a+');

        $text =
            PHP_EOL . 'Письмо для пользователя : ' . $subscriber->username . ', отправлено на почту ' . $subscriber->email . ', время отправки ' . $blog->created_at . PHP_EOL .
            'Заголовок письма: На сайте добавлена новая запись: “' . $blog->name . '”' . PHP_EOL .
            PHP_EOL .
            'Содержимое письма:' . PHP_EOL .
            PHP_EOL .
            'Новая статья: “' . $blog->name . '”' . PHP_EOL .
            PHP_EOL .
            '#Краткое описание статьи#' . PHP_EOL .
            BlogController::getPreviewBlogText($blog) . PHP_EOL .
            PHP_EOL .
            'Читать ' . $readHref . PHP_EOL .
            PHP_EOL .
            '-------' . PHP_EOL .
            PHP_EOL .
            'Отписаться от рассылки ' . $unsubHref . PHP_EOL;

        fwrite($file, $text);

        fclose($file);
        return 'Success';
    } else {
        return 'Error open file';
    }
}