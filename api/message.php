<?php
require '../tools.func.php';
require '../db.func.php';
header('Content-Type: application/json');
$prefix = getDBPrefix();
$method = $_SERVER['REQUEST_METHOD'];
$response = ['code' => 200, 'msg' => ''];

try {
   // $id  = $_GET['id'];
    switch ($method) {
        // 获取留言（列表/单个）
        case 'GET':
        $id = $_GET['id']??0;
        if($id>0){
            $sql = "SELECT m.*, u.username, c.name as cate_name 
                        FROM {$prefix}message m
                        LEFT JOIN {$prefix}user u ON m.uid = u.id
                        LEFT JOIN {$prefix}message_cate c ON m.cid = c.id
                        WHERE m.id = '$id'";
                $message = queryOne($sql);
                if ($message) {
                    $response['msg'] ='查询成功' ;
                    $response['data'] = $message;
                } else {
                    throw new Exception('留言不存在');
                }
        } else {
            $page = max(1, intval($_GET['page'] ?? 1));
            $per_page = isset($_GET['per_page']) ? intval($_GET['per_page']) : 15;
            $offset = ($page - 1) * $per_page;
            
          
            $where = [];
            if (isset($_GET['cid']) && $cid = intval($_GET['cid'])) {
                if ($cid > 0) {
                    $where[] = "m.cid = $cid";
                }
            }
            
            // 保留原有搜索逻辑
            if (!empty($_GET['search'])) {
                $search = addslashes(trim($_GET['search']));
                $where[] = "(m.title LIKE '%$search%' 
                           OR m.message LIKE '%$search%'
                           OR c.name LIKE '%$search%')";
            }

            $whereClause = !empty($where) ? 'WHERE ' . implode(' AND ', $where) : '';
            
            // 数据查询
            $sql = "SELECT m.*, u.username, c.name as cate_name, c.col
                    FROM {$prefix}message m
                    LEFT JOIN {$prefix}user u ON m.uid = u.id
                    LEFT JOIN {$prefix}message_cate c ON m.cid = c.id
                    $whereClause
                    ORDER BY m.created_at DESC 
                    LIMIT $per_page OFFSET $offset";
            $response['data'] = query($sql);
            
            // 总数查询（需同步where条件）
            $count_sql = "SELECT COUNT(*) as total 
                        FROM {$prefix}message m
                        LEFT JOIN {$prefix}message_cate c ON m.cid = c.id
                        $whereClause";
            $countResult = queryOne($count_sql);
            $response['total'] = $countResult['total'];
            $response['page'] = $page;
        }
        break;
        
        // 保存留言
        case 'POST':
            $title = htmlspecialchars(trim($_POST['title']));
            $uid = intval($_POST['uid']);
            $cid = intval($_POST['cid']);
            $message = htmlspecialchars(trim($_POST['message']));
            
            // 验证数据
            if (empty($title) || empty($message)) {
                throw new Exception('标题和内容不能为空');
            }
            
            // 验证用户和分类
            if (!queryOne("SELECT id FROM {$prefix}user WHERE id = $uid")) {
                throw new Exception('用户不存在');
            }
            if (!queryOne("SELECT id FROM {$prefix}message_cate WHERE id = $cid")) {
                throw new Exception('分类不存在');
            }
            
            $sql = "INSERT INTO {$prefix}message(title, uid, cid, message, created_at)
                    VALUES('$title', $uid, $cid, '$message', NOW())";
                          $exec = execute($sql);
                        if ($exec) {
                            $response['msg'] ='添加成功' ;
                        } else {
                            throw new Exception('添加失败');
                        }
            break;
        
        // 更新留言
        case 'PUT':
            parse_str(file_get_contents('php://input'), $_PUT);
            $id = intval($_PUT['id']);
            $title = htmlspecialchars(trim($_PUT['title']));
            $uid = intval($_PUT['uid']);
            $cid = intval($_PUT['cid']);
            $message = htmlspecialchars(trim($_PUT['message']));
            
            // 数据验证（同上）...
            
            $sql = "UPDATE {$prefix}message SET
                    title = '$title',
                    uid = $uid,
                    cid = $cid,
                    message = '$message'
                    WHERE id = $id";
            $exec = execute($sql);
            if ($exec) {
                $response['msg'] ='更新成功' ;
            } else {
                throw new Exception('更新失败');
            }
            break;
        
        // 删除留言
        case 'DELETE':
            $id = intval($_GET['id']);
            $sql = "DELETE FROM {$prefix}message WHERE id = $id";
            $exec = execute($sql);
            if ($exec) {
                $response['msg'] ='删除成功' ;
            } else {
                throw new Exception('删除失败');
            }
            break;
        
        default:
            throw new Exception('无效请求方法');
    }
} catch (Exception $e) {
    $response['code'] = 400;
    $response['msg'] = $e->getMessage();
}

echo json_encode($response);