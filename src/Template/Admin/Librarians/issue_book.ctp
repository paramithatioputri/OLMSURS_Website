<?= $this->element('header'); ?>
<div>
    <form>
        <div class="form-group">
            <label>Book Number:</label>
        </div>
        <div class="form-group">
            <label>Book Title:</label>
        </div>
        <div class="form-group">
            <label>Name:</label>
        </div>
        <div class="form-group">
            <label>Borrower ID:</label>
        </div>
        <div class="form-group">
            <label>Books Taken:</label>
        </div>
        <div class="form-group">
            <label>Maximum Allowed:</label>
        </div>
        <div class="form-group">
            <label>Issue Date:</label>
        </div>
        <div class="form-group">
            <label>Due Date:</label>
        </div>
    </form>
    <button type="submit">Issue Book</button>
</div>
<div>
    <label>Search:</label>
    <input type="text" placeholder="Enter Borrower ID"/>
    <button type="button">Search</button>
</div>
