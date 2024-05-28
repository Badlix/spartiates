<?php

namespace controls;

use exception\CannotCreateException;
use exception\NotFoundException;
use repository\QuestionsRepository;
use view\View;

class QuestionsController
{
    /**
     * @var mixed
     */
    private mixed $repository;

    public function __construct()
    {
        $this->repository = new QuestionsRepository();
    }


    public function showQuestions(): void
    {
        try {
            $path = 'view/adminPages/questions.php';
            View::display('Questions', $path, $this->repository->getAll());
        } catch (NotFoundException $ERROR) {
            file_put_contents('log/HockeyGame.log', $ERROR->getMessage() . "\n", FILE_APPEND | LOCK_EX);
            echo $ERROR->getMessage();
        }
    }

    public function getRandomQuestion(): void
    {
        if (empty($_SESSION['randomQuestion'])) {
            $question = $this->repository->getRandomQuestion();
            $_SESSION['randomQuestion'] = $question;
        }
        if (!empty($_SESSION['randomQuestion'])) {
            $temp = array('text' => $_SESSION['randomQuestion'][0]->getText(),
                'answer' => $_SESSION['randomQuestion'][0]->getAnswer(),
                'false1' => $_SESSION['randomQuestion'][0]->getFalse1(),
                'false2' => $_SESSION['randomQuestion'][0]->getFalse2());
            $_SESSION['randomQuestion'] = array_slice($_SESSION['randomQuestion'], 1);
            echo json_encode($temp);
        }
    }

    public function createQuestion($text, $true, $false1, $false2): void
    {
        try {
            $this->repository->createQuestion(trim($text), trim($true), trim($false1), trim($false2));
        } catch (CannotCreateException $ERROR) {
            file_put_contents('log/HockeyGame.log', $ERROR->getMessage() . "\n", FILE_APPEND | LOCK_EX);
            echo $ERROR->getMessage();
        }
    }

    public function deleteQuestion($id): void
    {
        try {
            $this->repository->deleteQuestionById($id);
        } catch (NotFoundException $ERROR) {
            file_put_contents('log/HockeyGame.log', $ERROR->getMessage() . "\n", FILE_APPEND | LOCK_EX);
            echo $ERROR->getMessage();
        }
    }

    public function updateQuestion($id, $text, $true, $false1, $false2): void
    {
        try {
            $this->repository->updateQuestionById($id, trim($text), trim($true), trim($false1), trim($false2));
        } catch (NotFoundException $ERROR) {
            file_put_contents('log/HockeyGame.log', $ERROR->getMessage() . "\n", FILE_APPEND | LOCK_EX);
            echo $ERROR->getMessage();
        }
    }

    public function searchQuestion($searchTerm): void
    {
        $questions = $this->repository->search($searchTerm);
        foreach ($questions as $question) {
            echo '
            <div class="flex flex-col items-center justify-center w-full p-6 bg-white border border-gray-200 rounded-lg shadow-md">
                <div class="flex flex-row items-center justify-between w-full mt-2">
                    <p class="text-lg font-medium text-gray-800 mr-5"> ' . $question->getText() . ' </p>
                    <div class="flex flex-row space-x-2">
                        <a href="/updateQuestion&id=' . $question->getId() . '" class="inline-block w-8 h-8 bg-customBlue hover:bg-blue-700 rounded cursor-pointer">
                            <img class="p-1" src="/assets/images/edit.svg" alt="Delete">
                        </a>
                    </div>
                </div>
            </div>';
        }
    }

    public function showUpdateForm($url, $id): void
    {
        $path = 'view/forms/' . $url . '.php';
        View::display('MISE A JOUR', $path, $this->repository->getById($id));
    }

}