let todoList = null;
let dragSrcEl = null;
let filterState = 'pending';
let showLimit = 10;
let renderedCount = 0;
let loading = false;

document.addEventListener("DOMContentLoaded", () => {
    todoList = document.getElementById("todo-list");
    renderTodoList();
    setupFilterButtons();
    setupScrollLoadMore();
    setupInputEnter();
});

// Add new todo
function addTodo() {
    const input = document.getElementById("todo-input");
    const value = input.value.trim();
    if (value === "") return;

    const now = new Date();
    const createdDate = now.toLocaleDateString("en-GB", {
        day: "2-digit",
        month: "long",
        year: "numeric"
    });

    const todo = {
        text: value,
        date: createdDate,
        completed: false
    };

    saveTodo(todo);
    clearTodoList();
    renderTodoList();
    input.value = "";
}

// Clear and reset render state
function clearTodoList() {
    todoList.innerHTML = "";
    renderedCount = 0;
}

// Render one todo item
function renderTodoItem(todo, index) {
    if (
        (filterState === 'completed' && !todo.completed) ||
        (filterState === 'pending' && todo.completed)
    ) return;

    const li = document.createElement("li");
    li.className = "todo-item fade-in";
    li.dataset.index = index;
    if (todo.completed) li.classList.add("completed");
    li.setAttribute("draggable", true);

    // Checkbox
    const checkDiv = document.createElement("div");
    checkDiv.className = "todo-check";
    const checkBtn = document.createElement("button");
    checkBtn.innerHTML = `<i class='bx bx-check'></i>`;
    checkBtn.onclick = () => {
        todo.completed = !todo.completed;
        updateTodo(index, todo);
        clearTodoList();
        renderTodoList();
    };
    checkDiv.appendChild(checkBtn);

    // Details
    const detail = document.createElement("div");
    detail.className = "todo-details";

    const span = document.createElement("span");
    span.textContent = todo.text;
    span.contentEditable = !todo.completed;
    if (todo.completed) {
        span.classList.add("readonly");
    } else {
        span.classList.remove("readonly");
    }
    span.onblur = () => {
        todo.text = span.innerText.trim();
        updateTodo(index, todo);
    };

    const dateDisplay = document.createElement("div");
    dateDisplay.className = "todo-created-date";
    dateDisplay.textContent = `${todo.date || 'N/A'}`;

    detail.appendChild(span);
    detail.appendChild(dateDisplay);

    // Actions
    const actions = document.createElement("div");
    actions.className = "todo-actions";
    const delBtn = document.createElement("button");
    delBtn.innerHTML = `<i class='bx bx-trash'></i>`;
    delBtn.onclick = () => {
        removeTodo(index);
    };
    actions.appendChild(delBtn);

    // Final assembly
    li.appendChild(checkDiv);
    li.appendChild(detail);
    li.appendChild(actions);

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
            const todos = getTodos();
            const fromIndex = parseInt(dragSrcEl.dataset.index);
            const toIndex = parseInt(li.dataset.index);

            if (fromIndex !== toIndex) {
                const movedItem = todos.splice(fromIndex, 1)[0];
                todos.splice(toIndex, 0, movedItem);
                saveTodos(todos);
                clearTodoList();
                renderTodoList();
            }
        }
    });

    todoList.appendChild(li);
}

// Get todos from localStorage
function getTodos() {
    return JSON.parse(localStorage.getItem("todos")) || [];
}

// Save full todos list
function saveTodos(todos) {
    localStorage.setItem("todos", JSON.stringify(todos));
}

// Add one todo
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
    clearTodoList();
    renderTodoList();
}

// Render visible todos with limit
function renderTodoList() {
    const todos = getTodos();

    let filtered = todos.filter(todo => {
        if (filterState === 'completed') return todo.completed;
        if (filterState === 'pending') return !todo.completed;
        return true;
    });

    const reversed = [...filtered].reverse();
    const nextTodos = reversed.slice(renderedCount, renderedCount + showLimit);

    nextTodos.forEach(todo => {
        const index = todos.findIndex(t => t.text === todo.text && t.date === todo.date && t.completed === todo.completed);
        if (index !== -1) renderTodoItem(todo, index);
    });

    renderedCount += nextTodos.length;
    loading = false;

    // Show completed image if no pending todos
    const imageDiv = document.getElementById("completed-image");

    if (filterState === 'pending') {
        const pendingTodos = getTodos().filter(t => !t.completed);
        if (pendingTodos.length === 0) {
            imageDiv.style.display = "flex";
        } else {
            imageDiv.style.display = "none";
        }
    } else {
        imageDiv.style.display = "none";
    }
}

// Infinite scroll loading
function setupScrollLoadMore() {
    todoList.addEventListener('scroll', () => {
        if (loading) return;

        const nearBottom = todoList.scrollTop + todoList.clientHeight >= todoList.scrollHeight - 20;

        if (nearBottom) {
            loading = true;
            setTimeout(() => {
                renderTodoList();
            }, 300);
        }
    });
}

// Filter buttons
function setupFilterButtons() {
    const buttons = document.querySelectorAll('.filter-btn');
    buttons.forEach(btn => {
        btn.addEventListener('click', () => {
            buttons.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            filterState = btn.getAttribute('data-filter');
            clearTodoList();
            renderTodoList();
        });
    });
}

// Add on Enter key
function setupInputEnter() {
    const input = document.getElementById("todo-input");
    input.addEventListener("keypress", (e) => {
        if (e.key === "Enter") {
            addTodo();
        }
    });
}