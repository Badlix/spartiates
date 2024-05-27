<?php

namespace controls;

use exception\NotFoundException;
use repository\SessionRepository;

class SessionController
{
    /**
     * @var mixed
     */
    private mixed $repository;

    public function __construct()
    {
        $this->repository = new SessionRepository();
    }

    public function addSessionPlayer($pseudo, $email): void
    {
        $_SESSION['id'] = $this->repository->addSessionPlayer(trim($pseudo), trim($email), $_SESSION['code']);
        $_SESSION['pseudo'] = $pseudo;
        $_SESSION['email'] = $email;
    }

    public function showRanking(): void
    {
        $data = $this->repository->getRanking();
        $i = 1;
        foreach ($data as $sessionUser) {
            echo '
            <tr class="bg-white">
                <td class="px-4 py-2 border-t border-b text-center font-bold">' . $i . '</td>
                <td class="px-4 py-2 border-t border-b text-center">' . $sessionUser->getLogin() . '</td>
                <td class="px-4 py-2 border-t border-b text-center">' . $sessionUser->getScore() . '</td>
                <td class="p-2 border bg-[var(--color-bg)] text-center">
                    <button data-id="' . $sessionUser->get_id() . '" data-action="deleteUser" class="deleteButton actionButton inline-block w-8 h-8 bg-red-500 hover:bg-red-700 rounded" type="button">
                        <img class="p-1" src="/assets/images/trashcan.svg" alt="Delete">
                    </button>
                </td>
            </tr>';
            $i++;
        }
    }

    public function deleteUser($id): void
    {
        try {
            $this->repository->deleteUserById($id);
        } catch (NotFoundException $ERROR) {
            file_put_contents('log/HockeyGame.log', $ERROR->getMessage() . "\n", FILE_APPEND | LOCK_EX);
            echo $ERROR->getMessage();
        }
    }

    public function isInActiveSession(): void
    {
        $codesController = new CodesController();
        if (!empty($_SESSION['code'] && $codesController->codeIsActive($_SESSION['code'])) && $this->repository->isInSession($_SESSION['id'])) {
            echo 'true';
        } elseif (!empty($_SESSION['code'] && isset($_SESSION['id']) && $this->repository->isInSession($_SESSION['id']))) {
            echo 'notActive';

        } else {
            $_SESSION['code'] = null;
            $_SESSION['randomQuestion'] = null;
            echo 'false';
        }
    }

    public function showEndGame($score): void
    {
        try {
            if ($score == 0)
                $score = $this->repository->getScore($_SESSION['id']);
            if (isset($_SESSION['id']) && $this->repository->isInSession($_SESSION['id'])) {
                $this->repository->setScore($_SESSION['id'], $score);
                $sessionUser = $this->repository->getSessionUser($_SESSION['id']);
                echo json_encode($sessionUser);
            }
        } catch (NotFoundException $ERROR) {
            echo $ERROR->getMessage();
            echo $_SESSION['id'];
        }
    }

    public function setSessionSpart($spartiateId): void
    {
        if (isset($_SESSION['id']) && $this->repository->isInSession($_SESSION['id'])) {
            $_SESSION['spartiateId'] = $spartiateId;
        }
    }

}