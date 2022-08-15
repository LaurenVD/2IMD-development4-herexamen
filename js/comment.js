document.querySelector("#submitComment").addEventListener("click", function(event){
    event.preventDefault();
    const taskId = document.querySelector("#submitComment").dataset.taskid;
    const text = document.querySelector("#commentText").value;

    const formData = new FormData();
    formData.append('taskId', taskId);
    formData.append('text', text);

    fetch('./ajax/save_comment.php', {
        method: 'POST',
        body: formData
    })


    .then(function(response) { return response.json(); })
    .then(result => {
        document.querySelector("#commentText").value = " ";

        let newComment = document.createElement('li');
        
        let header = document.createElement('h4');
        header.innerHTML = result.username + ' reacted:';
        header.classList.add('detailsText');
        let text = document.createElement('p');
        text.innerHTML = result.body;
        newComment.appendChild(header);
        newComment.appendChild(text);

        document.querySelector("#commentList").appendChild(newComment);
    });
});