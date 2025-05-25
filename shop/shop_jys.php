
  <?php
    require 'header.php'
    ?>
   <style>
    body{position: relative;}
</style>
        <div class="jys_Main">
            <div class="jys_M Width1440">
                    <!-- 左侧筛选区 -->
                    <div class="jys_sidebar">
                        <div class="filter_card">
                            <h3><i class="glyphicon glyphicon-th-list"></i>分类导航</h3>
                            <ul class="category_list">
                                <li class="active">全部分类</li>
                                <li>服装配饰</li>
                                <li>数码设备</li>
                                <li>手作商品</li>
                                <li>虚拟物品</li>
                            </ul>
                            
                            <h3><i class="glyphicon glyphicon-th-large"></i> 精细筛选</h3>
                            <div class="filter_group">
                                <h4>价格范围（奶油币）</h4>
                                <div class="price_range">
                                    <input type="number" placeholder="最低价">
                                    <span>-</span>
                                    <input type="number" placeholder="最高价">
                                </div>
                                
                                <h4>交易方式</h4>
                                <div class="trade_type">
                                    <label><input type="checkbox"> 线上交易</label>
                                    <label><input type="checkbox"> 星际快递</label>
                                </div>
                            </div>
                        </div>
                    </div>
        
                    <!-- 主内容区 -->
                    <div class="jys_main">
                        <!-- 搜索栏 -->
                        <div class="search_bar">
                            <div class="search_box">
                                <input type="text" placeholder="搜索你想要的宝贝...">
                                <button class="search_btn"><i class="glyphicon glyphicon-search"></i></button>
                            </div>
                            <div class="sort_options">
                                <select>
                                    <option>综合排序</option>
                                    <option>最新发布</option>
                                    <option>价格最低</option>
                                </select>
                            </div>
                        </div>
        
                        <!-- 商品列表 -->
                        <div class="goods_list">
                            <div class="goods_card">
                                <div class="goods_thumb">
                                    <img src="./images/index/s14.jpg">
                                    <div class="goods_tag">担保交易</div>
                                </div>
                                <div class="goods_info">
                                    <h3 class="goods_title">サキュバスの森~モンスター娘達とのゲーム</h3>
                                    <div class="price"><i class="glyphicon glyphicon-jpy"></i> 258 <span class="original_price">399</span></div>
                                    <div class="seller_info">
                                        <img src="./images/shop/s23.png" class="seller_avatar">
                                        <div class="seller_detail">
                                            <div class="seller_name">魅魔之森~我被魔物娘包围了</div>
                                            <div class="seller_rating">⭐⭐⭐⭐⭐ 4.9</div>
                                        </div>
                                    </div>
                                    <div class="goods_tags">
                                        <span class="tag">PC游戏</span>
                                        <span class="tag">生肉资源</span>
                                    </div>
                                    <div class="goods_actions">
                                        <button class="want_btn"><i class="glyphicon glyphicon-heart"></i>想要</button>
                                        <button class="chat_btn"><i class="glyphicon glyphicon-cloud"></i>聊聊</button>
                                    </div>
                                </div>
                            </div>
                            <div class="goods_card">
                                <div class="goods_thumb">
                                    <img src="./images/index/s15.jpg">
                                    <div class="goods_tag">担保交易</div>
                                </div>
                                <div class="goods_info">
                                    <h3 class="goods_title">苍之彼方的四重奏：交予世界的答卷</h3>
                                    <div class="price"><i class="glyphicon glyphicon-jpy"></i> 258 <span class="original_price">399</span></div>
                                    <div class="seller_info">
                                        <img src="./images/shop/s23.png" class="seller_avatar">
                                        <div class="seller_detail">
                                            <div class="seller_name">Palentum</div>
                                            <div class="seller_rating">⭐⭐⭐⭐⭐ 4.9</div>
                                        </div>
                                    </div>
                                    <div class="goods_tags">
                                        <span class="tag">PC游戏</span>
                                        <span class="tag">生肉资源</span>
                                    </div>
                                    <div class="goods_actions">
                                        <button class="want_btn"><i class="glyphicon glyphicon-heart"></i>想要</button>
                                        <button class="chat_btn"><i class="glyphicon glyphicon-cloud"></i>聊聊</button>
                                    </div>
                                </div>
                            </div>
                            <div class="goods_card">
                                <div class="goods_thumb">
                                    <img src="./images/index/s16.jpg">
                                    <div class="goods_tag">担保交易</div>
                                </div>
                                <div class="goods_info">
                                    <h3 class="goods_title">すく～るふぁいぶ～五つの秘密の物語</h3>
                                    <div class="price"><i class="glyphicon glyphicon-jpy"></i> 258 <span class="original_price">399</span></div>
                                    <div class="seller_info">
                                        <img src="./images/shop/s23.png" class="seller_avatar">
                                        <div class="seller_detail">
                                            <div class="seller_name">Palentum</div>
                                            <div class="seller_rating">⭐⭐⭐⭐⭐ 4.9</div>
                                        </div>
                                    </div>
                                    <div class="goods_tags">
                                        <span class="tag">PC游戏</span>
                                        <span class="tag">生肉资源</span>
                                    </div>
                                    <div class="goods_actions">
                                        <button class="want_btn"><i class="glyphicon glyphicon-heart"></i>想要</button>
                                        <button class="chat_btn"><i class="glyphicon glyphicon-cloud"></i>聊聊</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        
                    <!-- 右侧信息栏 -->
                    <div class="jys_sidebar_right">
                        <div class="notice_board">
                            <h3><i class="glyphicon glyphicon-bullhorn"></i> 交易须知</h3>
                            <ul class="notice_list">
                                <li>• 交易前请确认对方信用等级</li>
                                <li>• 大额交易建议使用担保支付</li>
                                <li>• 收到商品请及时确认</li>
                            </ul>
                        </div>
                        
                        <div class="credit_card">
                            <h3><i class="glyphicon glyphicon-star"></i>我的信用</h3>
                            <div class="credit_level">
                                <div class="level_progress">
                                    <div class="progress_bar" style="width: 75%"></div>
                                </div>
                                <div class="level_info">
                                    Lv.12 星尘商人
                                    <span>下一等级：需要200信用点</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
    require 'footer.php'
    ?>
        </div>
    </div>
   
    <script src="./js/main.js"></script>
</body>
</html>