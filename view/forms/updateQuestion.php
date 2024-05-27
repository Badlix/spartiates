<a href="/home" class="absolute left-5 top-5 w-20 h-20">
    <img class="p-2 bg-customBlue rounded-xl" src="/assets/images/home.svg" alt="Delete">
</a>
    <form class="bg-white p-10 rounded-md drop-shadow-xl flex flex-col justify-center items-center space-y-5" id="form" method="post">
        <input type="hidden" name="action" value="updateQuestion">
        <input type="hidden" name="id" value="<?= $data->getId() ?>">
        <h1> Mise à jour question </h1>
        <label>Question :
            <textarea class="w-full rounded-xl" type="text" name="text" required><?= $data->getText() ?></textarea>
        </label>
        <label>Bonne réponse :
            <textarea class="w-full rounded-xl" type="text" name="true" required><?= $data->getAnswer() ?></textarea>
        </label>
        <label>Mauvaise réponse 1 :
            <textarea class="w-full rounded-xl" type="text" name="false1" required><?= $data->getFalse1() ?></textarea>
        </label>
        <label>Mauvaise réponse 2 :
            <textarea class="w-full rounded-xl" type="text" name="false2" required><?= $data->getFalse2() ?></textarea>
        </label>
        <input class="bg-blue-500 rounded-xl text-lg py-4 px-8" type="submit" name="update" value="Mettre a jour">
    </form>
