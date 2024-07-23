async function passContent(content, id) {
    document.getElementById('postEditForm').action = "/posts/" + id;
    document.getElementById('postDeleteForm').action = "/posts/" + id;
    document.getElementById('postEditInput').value = content;
}

async function passPost(id) {
    document.getElementById('createCommentForm').action = "/posts/" + id + "/comments";
}
