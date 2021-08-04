<?php

class Flasher {
    public static function setFlash($message, $action, $type) {
        $_SESSION['flash'] = [
            'message' => $message,
            'action' => $action,
            'type' => $type
        ];
    }

    public static function flash() {
        if (isset($_SESSION['flash'])) {
            echo '<div class="alert alert-' . $_SESSION['flash']['type'] . ' alert-dismissible fade show" role="alert">
                        <strong>' . $_SESSION['flash']['message'] . '</strong>. ' . $_SESSION['flash']['action'] . '
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';

            unset($_SESSION['flash']);
        }
    }
}
