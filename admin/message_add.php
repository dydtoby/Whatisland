<?php
require 'header.php';
require '../tools.func.php';
require 'auth.php';
require '../db.func.php';
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">添加留言</h4>
            </div>
            <div class="card-body">
                <!-- <p style="color:#c00"><?php if (hasInfo()) echo getInfo(); ?></p> -->
                <form id="addForm">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">留言标题</label>
                                <input type="text" name="title" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">选择分类</label>
                                <select name="cid" class="form-control" required>
                                    <option value="">-- 请选择分类 --</option>
                                    <?php foreach ($cates as $cate): ?>
                                    <option value="<?php echo $cate['id']; ?>">
                                        <?php echo htmlspecialchars($cate['name']); ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">选择用户</label>
                                <select name="uid" class="form-control" required>
                                    <option value="">-- 请选择用户 --</option>
                                    <?php foreach ($users as $user): ?>
                                    <option value="<?php echo $user['id']; ?>">
                                        <?php echo htmlspecialchars($user['username']); ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>留言内容</label>
                                <textarea name="message" class="form-control" rows="5" required></textarea>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary pull-right">提交留言</button>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// 加载用户和分类
Promise.all([
    fetch('../api/users.php').then(res => res.json()),
    fetch('../api/categories.php').then(res => res.json())
]).then(([users, cates]) => {
    if (users.code === 200 && cates.code === 200) {
        // 填充用户下拉框
        const uidSelect = document.querySelector('[name="uid"]');
        uidSelect.innerHTML = users.data.map(u => `
            <option value="${u.id}">${u.username}</option>
        `).join('');
        
        // 填充分类下拉框
        const cidSelect = document.querySelector('[name="cid"]');
        cidSelect.innerHTML = cates.data.map(c => `
            <option value="${c.id}">${c.name}</option>
        `).join('');
    }
});

// 提交表单
document.getElementById('addForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    
    fetch('../api/message.php', {
        method: 'POST',
        body: formData
    }).then(res => res.json())
      .then(({ code, msg }) => {
          alert(msg);
          code === 200 && (window.location.href = 'message.php');
      });
});
</script>
<?php
require 'footer.php';