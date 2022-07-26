document.querySelector(".submitComment").addEventListener("click", function(event){
    event.preventDefault();
    let taskId = document.querySelector(".submitComment").dataset.taskid;
    let text = document.querySelector("#commentText").value;

    const formData = new FormData();
    formData.append('taskId', taskId);
    formData.append('text', text);

    fetch('./ajax/savecomment.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(result => {
        document.querySelector("#commentText").value = " ";

        let newComment = document.createElement('li');
        
        let username = document.createElement('h4');
        username.classList.add("detailsText");
        username.innerHTML = result.username + " reageerde:";

        let text = document.createElement('p');
        text.innerHTML = result.body;
        
        newComment.appendChild(username);
        newComment.appendChild(text);

        document.querySelector(".CommentList").appendChild(newComment);

    })
    .catch(error => {
        console.error('Error:', error);
    });
});