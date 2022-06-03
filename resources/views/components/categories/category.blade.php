<div class="content-wrapp">
    <div class="add-category">
        <form class="normal" method="POST" action="/admin/dashboard/categories/add">
            @csrf

            <label for="title">Title</label>
            <input type="text" name="title" required>

            <button type="submit">Add</button>

        </form>
    </div>
</div>