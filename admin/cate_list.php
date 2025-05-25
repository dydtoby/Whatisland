<?php
require '../tools.func.php';
require 'auth.php';
require '../db.func.php';
$prefix = getDBPrefix();

// 分页参数
$page = max(1, intval($_GET['page'] ?? 1));
$per_page = 15;
$offset = ($page - 1) * $per_page;

// 获取分类数据
$sql = "SELECT * FROM {$prefix}message_cate 
        ORDER BY id DESC 
        LIMIT $per_page OFFSET $offset";
$data = query($sql);

// 总数查询
$count_sql = "SELECT COUNT(*) FROM {$prefix}message_cate";
$total = queryOne($count_sql)['COUNT(*)'];

require 'header.php';
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="card-title">分类管理</h4>
                        <p class="card-category">共 <?php echo $total; ?> 个分类</p>
                    </div>
                    <div class="col-md-4 text-right">
                        <a href="cate_add.php" class="btn btn-success">
                            <i class="material-icons">add</i> 新增分类
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="text-primary">
                            <tr>
                                <th width="10%">ID</th>
                                <th width="30%">分类名称</th>
                                <th width="30%">颜色标识</th>
                                <th width="30%">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data as $item): ?>
                            <tr>
                                <td><?php echo $item['id']; ?></td>
                                <td><?php echo htmlspecialchars($item['name']); ?></td>
                                <td>
                                    <div class="color-preview" 
                                         style="background: <?php echo $item['col']; ?>;
                                                width: 24px;
                                                height: 24px;
                                                display: inline-block;
                                                border-radius: 4px;
                                                margin-right: 8px;">
                                    </div>
                                    <?php echo strtoupper($item['col']); ?>
                                </td>
                                <td>
                                    <a href="cate_edit.php?id=<?php echo $item['id']; ?>" 
                                       class="btn btn-sm btn-info">
                                        <i class="material-icons">edit</i>
                                    </a>
                                    <a href="cate_del.php?id=<?php echo $item['id']; ?>" 
                                       class="btn btn-sm btn-danger" 
                                       onclick="return confirm('确定删除该分类？')">
                                        <i class="material-icons">delete</i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                
                <!-- 分页 -->
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <?php if($page > 1): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?php echo $page-1; ?>">
                                上一页
                            </a>
                        </li>
                        <?php endif; ?>
                        
                        <?php 
                        $total_page = ceil($total / $per_page);
                        $start_page = max(1, $page - 2);
                        $end_page = min($total_page, $page + 2);
                        
                        for ($i = $start_page; $i <= $end_page; $i++): 
                        ?>
                        <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                            <a class="page-link" href="?page=<?php echo $i; ?>">
                                <?php echo $i; ?>
                            </a>
                        </li>
                        <?php endfor; ?>
                        
                        <?php if($page < $total_page): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?php echo $page+1; ?>">
                                下一页
                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
<?php
require 'footer.php';
?>