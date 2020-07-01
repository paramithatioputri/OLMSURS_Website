<?= $this->Html->css('page-config.css');?>

<?php $this->end('css')?>
<?php echo $this->element('header'); ?>
<form>
    <div class="form-group">
        <label>Book Number:</label>
        <input type="text" />
    </div>
    <div class="form-group">
        <label>ISBN:</label>
        <input type="text" />
    </div>
    <div class="form-group">
        <label>Title:</label>
        <input type="text" />
    </div>
    <div class="form-group">
        <label>Author:</label>
        <input type="text" />
    </div>
    <div class="form-group">
        <label>Publisher:</label>
        <input type="text" />
    </div>
    <div class="form-group">
        <label>Num of Pages:</label>
        <input type="number" />
    </div>
    <div class="form-group">
        <label>Subject:</label>
        <select>
            <option>Select Subject</option>
        </select>
    </div>
    <div class="form-group">
        <label>Language:</label>
        <select>
            <option>Select Language</option>
            <?php  ?>
        </select>
    </div>
    <div class="form-group">
        <label>Synopsis:</label>
        <textarea cols="40" rows="5"></textarea>
    </div>
    <div class="form-group">
        <label>Book Cover Image:</label>
        <input type="file" name="uploadBookPic"/>
    </div>
    <button type="submit">Publish Book</button>
</form>