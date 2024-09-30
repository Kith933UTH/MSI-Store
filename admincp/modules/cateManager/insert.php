<h2 class="content-title">Add category</h2>

<div class="main-content">
    <form method="POST" action="modules/cateManager/control.php">
        <div class="form-item">
            <label for="">Category name: </label>
            <input type="text" name="cateName" required>
        </div>

        <div class="form-item">
            <label for="">Category order: </label>
            <input type="number" name="cateOrder" required>
        </div>
        <button type="submit" name="insert">Submit</button>
    </form>
</div>