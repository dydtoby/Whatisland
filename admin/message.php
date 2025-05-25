<?php
require 'header.php';
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="card-title">留言管理</h4>
                    </div>
                    <div class="col-md-4 text-right">
                        <a href="message_add.php" class="btn btn-round btn-info" style="margin-left: 20px;">添加留言</a>
                        <form class="form-inline">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" 
                                       placeholder="搜索标题或内容" value="<?php echo htmlspecialchars($search); ?>">
                                <div class="input-group-append">
                                    <button class="btn btn-white btn-round" type="submit">
                                        <i class="material-icons">search</i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                    <thead class="text-primary">
                        <th width="5%">ID</th>
                        <th width="15%">留言标题</th>
                        <th width="25%">内容摘要</th>
                        <th width="15%">分类</th>
                        <th width="15%">留言用户</th>
                        <th width="15%">留言时间</th>
                        <th width="10%">操作</th>
                    </thead>
                    <tbody id="messageList"></tbody>
                        
                    </table>
                </div>
                
                <!-- 分页 -->
                <nav aria-label="Page navigation" id="pagination"></nav>
            </div>
        </div>
    </div>
</div>

<script>
// 加载留言列表
function loadMessages(page = 1, search = '') {
    
    fetch(`../api/message.php?page=${page}&search=${encodeURIComponent(search)}`)
        .then(res => res.json())
        .then(({ code, data, total, page: currentPage }) => {
            if (code !== 200) return;
            
            // 渲染表格
            const tbody = document.getElementById('messageList');
            tbody.innerHTML = data.map(msg => `
                <tr>
                    <td>${msg.id}</td>
                    <td>${msg.title.substring(0, 12)}${msg.title.length > 12 ? '...' : ''}</td>
                    <td>${msg.message.substring(0, 30)}${msg.message.length > 30 ? '...' : ''}</td>
                    <td>${msg.cate_name ? `<span class="badge badge-primary">${msg.cate_name}</span>` : '未分类'}</td>
                    <td>${msg.username || '已删除用户'}</td>
                    <td>${msg.created_at}</td>
                    <td>
                        <a href="message_edit.php?id=${msg.id}" class="btn btn-sm btn-info">
                            <i class="material-icons">edit</i>
                        </a>
                        <button onclick="deleteMessage(${msg.id})" class="btn btn-sm btn-danger">
                            <i class="material-icons">delete</i>
                        </button>
                    </td>
                </tr>
            `).join('');
            
            // 渲染分页
            // renderPagination(total, currentPage);
        });
}

// 删除留言
function deleteMessage(id) {
    if (!confirm('确定删除？')) return;
    fetch(`../api/message.php?id=${id}`, { method: 'DELETE' })
        .then(res => res.json())
        .then(({ code, msg }) => {
            alert(msg);
            code === 200 && loadMessages();
        });
}

// 初始化加载
document.addEventListener('DOMContentLoaded', () => {
    const urlParams = new URLSearchParams(location.search);
    loadMessages(urlParams.get('page') || 1, urlParams.get('search') || '');
});
</script>
<?php
require 'footer.php';
?>