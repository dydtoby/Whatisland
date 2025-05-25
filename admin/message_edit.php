<?php
require 'header.php';
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">编辑留言</h4>
                <p class="card-category">编辑留言信息</p>
            </div>
            <div class="card-body">
                <form id="editForm">
                <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">留言标题</label>
                                <input type="text" name="title" 
                                       value="<?php echo htmlspecialchars($message['title']); ?>" 
                                       class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">选择用户</label>
                                <select name="uid" class="form-control" required>
                                    <option value="">-- 请选择用户 --</option>
                                    <?php foreach ($users as $user): ?>
                                    <option value="<?php echo $user['id']; ?>"
                                        <?php if($user['id'] == $message['uid']) echo 'selected'; ?>>
                                        <?php echo htmlspecialchars($user['username']); ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">选择分类</label>
                                <select name="cid" class="form-control" required>
                                    <option value="">-- 请选择分类 --</option>
                                    <?php foreach ($cates as $cate): ?>
                                    <option value="<?php echo $cate['id']; ?>"
                                        <?php if($cate['id'] == $message['cid']) echo 'selected'; ?>>
                                        <?php echo htmlspecialchars($cate['name']); ?>
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
                                <textarea name="message" class="form-control" rows="5" required>
                                    <?php echo htmlspecialchars($message['message']); ?>
                                </textarea>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary pull-right">保存修改</button>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
const messageId = new URLSearchParams(location.search).get('id');

// 加载留言数据
fetch(`../api/message.php?id=${messageId}`)
    .then(res => res.json())
    .then(({ code, data }) => {
        if (code !== 200) return;
        console.log(data);
        
        document.querySelector('[name="title"]').value = data.title;
        document.querySelector('[name="message"]').value = data.message;
        document.querySelector('[name="uid"]').value = data.uid;
        document.querySelector('[name="cid"]').value = data.cid;
    });

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

// 提交更新
document.getElementById('editForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    
    fetch(`../api/message.php?id=${messageId}`, {
        method: 'PUT',
        body: new URLSearchParams(formData)
    }).then(res => res.json())
      .then(({ code, msg }) => {
          alert(msg);
          code === 200 && (window.location.href = 'message.php');
      });
});
</script>
<?php
require 'footer.php';