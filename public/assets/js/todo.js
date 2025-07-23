let todoList = null;
let dragSrcEl = null;
let filterState = 'all';

document.addEventListener("DOMContentLoaded", () => {
    todoList = document.getElementById("todo-list");
    renderTodoList();
});

// Add new todo
function addTodo() {
    const input = document.getElementById("todo-input");
    const date = document.getElementById("todo-date");
    const value = input.value.trim();
    const dueDate = date.value;

    if (value === "") return;

    const todo = {
        text: value,
        date: dueDate,
        completed: false
    };

    saveTodo(todo);
    renderTodoList();
    input.value = "";
    date.value = "";
}

// Render one todo item
function renderTodoItem(todo, index) {
    if (
        (filterState === 'completed' && !todo.completed) ||
        (filterState === 'pending' && todo.completed)
    ) return;

    const li = document.createElement("li");
    li.className = "todo-item";
    li.setAttribute("draggable", true);

    const detail = document.createElement("div");
    detail.className = "todo-details";

    const span = document.createElement("span");
    span.textContent = todo.text;
    span.contentEditable = true;
    span.onblur = () => {
        todo.text = span.innerText.trim();
        updateTodo(index, todo);
    };

    const date = document.createElement("input");
    date.type = "date";
    date.className = "todo-date";
    date.value = todo.date || '';
    date.onchange = () => {
        todo.date = date.value;
        updateTodo(index, todo);
    };

    detail.appendChild(span);
    detail.appendChild(date);

    const actions = document.createElement("div");
    actions.className = "todo-actions";

    const doneBtn = document.createElement("button");
    doneBtn.innerHTML = "✔️";
    doneBtn.onclick = () => {
        todo.completed = !todo.completed;
        updateTodo(index, todo);
        renderTodoList();
    };

    const delBtn = document.createElement("button");
    delBtn.innerHTML = "🗑️";
    delBtn.onclick = () => {
        removeTodo(index);
    };

    actions.appendChild(doneBtn);
    actions.appendChild(delBtn);
    li.appendChild(detail);
    li.appendChild(actions);
    if (todo.completed) li.classList.add("completed");

    // Drag events
    li.addEventListener("dragstart", (e) => {
        dragSrcEl = li;
        e.dataTransfer.effectAllowed = "move";
    });

    li.addEventListener("dragover", (e) => {
        e.preventDefault();
        li.style.border = "2px dashed #ccc";
    });

    li.addEventListener("dragleave", () => {
        li.style.border = "1px solid #eee";
    });

    li.addEventListener("drop", () => {
        li.style.border = "1px solid #eee";
        if (dragSrcEl !== li) {
            const fromIndex = [...todoList.children].indexOf(dragSrcEl);
            const toIndex = [...todoList.children].indexOf(li);
            const todos = getTodos();
            const movedItem = todos.splice(fromIndex, 1)[0];
            todos.splice(toIndex, 0, movedItem);
            saveTodos(todos);
            renderTodoList();
        }
    });

    todoList.appendChild(li);
}

// Get from localStorage
function getTodos() {
    return JSON.parse(localStorage.getItem("todos")) || [];
}

// Save entire list
function saveTodos(todos) {
    localStorage.setItem("todos", JSON.stringify(todos));
}

// Add one todo to list
function saveTodo(todo) {
    const todos = getTodos();
    todos.push(todo);
    saveTodos(todos);
}

// Update a todo
function updateTodo(index, updatedTodo) {
    const todos = getTodos();
    todos[index] = updatedTodo;
    saveTodos(todos);
}

// Remove a todo
function removeTodo(index) {
    let todos = getTodos();
    todos.splice(index, 1);
    saveTodos(todos);
    renderTodoList();
}

// Render all todos
function renderTodoList() {
    const todos = getTodos();
    todoList.innerHTML = "";
    todos.forEach((todo, index) => {
        renderTodoItem(todo, index);
    });
}

// Filter toggle
function filterTodos(state) {
    filterState = state;
    document.querySelectorAll('.filter-btn').forEach(btn => btn.classList.remove('active'));
    document.querySelector(`.filter-btn[onclick*="${state}"]`).classList.add('active');
    renderTodoList();
}
