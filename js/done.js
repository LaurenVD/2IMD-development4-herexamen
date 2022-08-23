//bron: boek javascript & jquery door Jon Duckett

document.querySelectorAll('.doneBtnAnchor').forEach(item => {
    item.addEventListener("click", function (e) {
        e.preventDefault();
        const taskId = item.dataset.taskId;
        console.log(item.dataset);
        const formData = new FormData();
        formData.append('taskId', taskId);

        fetch('./ajax/done_handler.php', {
            method: 'POST',
            body: formData
        })
            .then(function (response) { return response.json(); })
            .then(result => {
                let checkMark = "./images/donegrey.svg";
                if (result.done === 1) {
                    checkMark = "./images/doneblue.svg";
                }

                document.querySelector(`.doneBtnAnchor[data-task-id="${result.id}"] img`).src = checkMark;
            });
    });
});