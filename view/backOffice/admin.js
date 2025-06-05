// Simulated data (replace with API calls for real data)
let posts = [
    { id: 1, description: "First Post", image: "image1.jpg" },
    { id: 2, description: "Second Post", image: "image2.jpg" },
];

let comments = [
    { id: 1, comment: "Nice Post!", postId: 1 },
    { id: 2, comment: "Great Content!", postId: 2 },
];

// Render posts
const renderPosts = () => {
    const postsTableBody = document.getElementById("posts-table-body");
    postsTableBody.innerHTML = "";

    posts.forEach(post => {
        const row = document.createElement("tr");
        row.innerHTML = `
            <td>${post.id}</td>
            <td>${post.description}</td>
            <td><img src="${post.image}" alt="Post Image" width="50"></td>
            <td>
                <button class="btn btn-primary btn-sm" onclick="editPost(${post.id})">Edit</button>
                <button class="btn btn-danger btn-sm" onclick="deletePost(${post.id})">Delete</button>
            </td>
        `;
        postsTableBody.appendChild(row);
    });
};

// Render comments
const renderComments = () => {
    const commentsTableBody = document.getElementById("comments-table-body");
    commentsTableBody.innerHTML = "";

    comments.forEach(comment => {
        const row = document.createElement("tr");
        row.innerHTML = `
            <td>${comment.id}</td>
            <td>${comment.comment}</td>
            <td>${comment.postId}</td>
            <td>
                <button class="btn btn-primary btn-sm" onclick="editComment(${comment.id})">Edit</button>
                <button class="btn btn-danger btn-sm" onclick="deleteComment(${comment.id})">Delete</button>
            </td>
        `;
        commentsTableBody.appendChild(row);
    });
};

// Edit and delete functionality
const editPost = (id) => {
    const newDescription = prompt("Edit Post Description:");
    if (newDescription) {
        const post = posts.find(p => p.id === id);
        post.description = newDescription;
        renderPosts();
    }
};

const deletePost = (id) => {
    posts = posts.filter(p => p.id !== id);
    renderPosts();
};

const editComment = (id) => {
    const newComment = prompt("Edit Comment:");
    if (newComment) {
        const comment = comments.find(c => c.id === id);
        comment.comment = newComment;
        renderComments();
    }
};

const deleteComment = (id) => {
    comments = comments.filter(c => c.id !== id);
    renderComments();
};

// Initial render
renderPosts();
renderComments();
