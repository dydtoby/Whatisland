
  <?php
    require 'header.php';
    $prefix = getDBPrefix();
    $user_id =getSession('id', 'shop'); ;
    $sql = "SELECT images, username, jf,uid
            FROM {$prefix}user 
            WHERE id = '$user_id'";
    $user = queryOne($sql); 
    $avatar_uid = $user['uid'] ?? 0;
    $bTmg_src = "https://workers.vrp.moe/bilibili/avatar/".$avatar_uid;
    ?>
    <style>
    /* body{position: relative;} */
    /* nav{position: absolute;left: 50%;transform: translateX(-50%);} */
    /* .banner{position: absolute;} */
    body {
  background-image: url('./images/banner1.jpg');
  background-repeat: no-repeat;
  background-position: center center;
  background-size: cover;
  background-attachment: fixed; /* 关键属性 */
  min-height: 100vh;
  margin: 0;
  position: relative;
}
.Main_S_M{
    top:1000px;
    position: relative;
}

    </style>
    <div class="Main_S">
    <div class="logo">
    <img src="./images/logo.png">
    </div>
    <div class="touxiang">
        <img class="bTmg" 
            src="<?php echo $bTmg_src; ?>"
            referrerpolicy="no-referrer"
            loading="lazy"
            alt="B站头像"
            onerror="this.style.display='none'">
        <img class="b2Tmg" 
            src="<?php echo !empty($user['images']) ? './images/'.$user['images'] : './images/i3.png'; ?>"
            alt="本地头像">
    </div>
    <div class="Main_S_M">
     <!-- <section class="banner">
        <div class="bannerImg" style="background-image:url('./images/banner1.jpg');"></div>
    </section> -->
    <div class="bgImg2">
        <!-- <img src="" alt="" referrerpolicy="no-referrer"> -->
        <img src="./images/i1.jpg" alt="">

    </div>
    <div class="main Width1440" style="background: #fff;border-radius:20px;padding: 20px;">
        <div class="index_top">
            <div class="index_top_l">
                <h2>库莉姆Cream</h2>
                <img src="" alt="" referrerpolicy="no-referrer">
                <div class="index_top_l_m">
                    <p>个人空间:</p>
                    <a href=""  target="_blank"><span></span></a>
                </div>
                <div class="index_top_l_m">
                    <p>直播间:</p>
                    <a href="" target="_blank"><span></span></a>
                </div>
            </div>
            <div class="index_top_c">
                <ul class="index_top_c_t">
                    <li>
                        <h2>关注</h2>
                        <div class="con">
                            <img src="./images/i3.jpg" alt="">
                            <p></p>
                        </div>
                    </li>
                    <li>
                        <h2>视频</h2>
                        <div class="con">
                            <img src="./images/i4.jpg" alt="">
                            <p></p>
                        </div>
                    </li>
                </ul>
                <div class="index_top_c_b">
                    <div class="index_top_c_b_l">
                        <h2>签名</h2>
                        <p></p>
                    </div>
                    <div class="index_top_c_b_r" style="display:none;">
                        <h2>24小时粉丝变化</h2>
                        <div class="con">
                            <img src="./images/i5.jpg" alt="">
                            <p></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="xian">
            <img src="./images/i9.jpg" alt="">
        </div>
        <div class="index_two">
            <ul>
                <li>
                    <h2>舰团</h2>
                    <div class="con">
                        <img src="./images/i6.jpg" alt="">
                        <p class="jtTitle"></p>
                    </div>
                </li>
                <li>
                    <h2>关注/舰团 比</h2>
                    <div class="con">
                        <img style="width: 100px;" src="./images/i7.jpg" alt="">
                        <p class="jtbTitle"></p>
                    </div>
                </li>
                <li>
                    <h2>直播间</h2>
                    <div class="con">
                        <p class="icon zbjTitle"></p>
                    </div>
                </li>
                <!-- <li>
                    <h2>Zeroroku by Jannchie见齐</h2>
                    <div class="con">
                        <img src="./images/i8.jpg" alt="">
                        <a target="_blank" class="midUrl"><p style="color: #5073ac;" class="midUrlCon"></p></a>
                    </div>
                </li> -->
            </ul>
        </div>
        <div class="xian">
            <img src="./images/i9.jpg" alt="">
        </div>
    <ul class="index_three">
        <li>
            <div class="index_three_top">
                <h2 class="start">关注历史</h2>
                <div class="right">(一部分)</div>
            </div>
            <div class="index_three_tu1"></div>
            <!-- <img src="./images/i11.jpg" alt=""> -->
            <!-- <div class="chart-container">
                    <div id="main"></div>
                    <div id="dateDisplay" class="date-display"></div>
                </div> -->
                <div class="chart-container">
        <div id="main">
            <div class="loading-overlay">数据加载中...</div>
        </div>
    </div>

        </li>
        <li>
            <div class="index_three_top">
                <h2>舰团变化</h2>
            </div>
            <!-- <img src="./images/i12.jpg" alt=""> -->
            <!-- <div class="chart-container">
                <div id="main1"></div>
                <div id="dateDisplay1" class="date-display"></div>
            </div> -->
            <div class="chart-card">
        <!-- <div class="card-header">舰团变化</div> -->
        <div id="guardChart">
            <div class="loading-mask">数据加载中...</div>
        </div>
    </div>
        </li>
    </ul>
    <div class="xian" style="display:none;">
            <img src="./images/i9.jpg" alt="">
        </div>
    <div class="index_four"style="display:none;">
        <h2>过去一周</h2>
        <table>
            <thead>
                <tr>
                    <th>日期</th>
                    <th>关注增量</th>
                    <th>总关注</th>
                    <th>日播放</th>
                    <th>总播放</th>
                    <th>舰团变化</th>
                    <th>舰团</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>2-25</td>
                    <td class="green">+72</td>
                    <td>600,118</td>
                    <td>0</td>
                    <td>0</td>
                    <td class="red">-6</td>
                    <td>197</td>
                </tr>
                <tr>
                    <td>2-24</td>
                    <td class="green">+1,032</td>
                    <td>600,046</td>
                    <td>0</td>
                    <td>0</td>
                    <td class="green">+2</td>
                    <td>203</td>
                </tr>
                <tr>
                    <td>2-23</td>
                    <td class="green">+882</td>
                    <td>599,014</td>
                    <td>0</td>
                    <td>0</td>
                    <td class="red">-1</td>
                    <td>201</td>
                </tr>
                <tr>
                    <td>2-22</td>
                    <td class="green">+1,310</td>
                    <td>598,132</td>
                    <td>0</td>
                    <td>0</td>
                    <td class="red">-1</td>
                    <td>202</td>
                </tr>
                <tr>
                    <td>2-21</td>
                    <td class="green">+582</td>
                    <td>596,822</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>203</td>
                </tr>
                <tr>
                    <td>2-20</td>
                    <td class="green">+1,428</td>
                    <td>596,240</td>
                    <td>0</td>
                    <td>0</td>
                    <td class="green">+3</td>
                    <td>203</td>
                </tr>
                <tr>
                    <td>2-19</td>
                    <td class="green">+149</td>
                    <td>594,812</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>200</td>
                </tr>
                <tr>
                    <td>日平均</td>
                    <td class="green">+779</td>
                    <td>-</td>
                    <td>0</td>
                    <td>-</td>
                    <td>0</td>
                    <td>-</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="index_five" style="display:none;">
        <!-- <img src="./images/i13.jpg" alt=""> -->
        <img src="./images/i14.jpg" alt="">
        <div class="index_five_con">
            <h2>直播间弹幕: <span>BILICHAT</span> 
                <i class="fn">by 3shain</i>
            </h2>
            <ul>
                <li>
                    <img src="./images/i15.jpg" alt="">
                    <span>BILICHATA</span>
                    <p>CONNECTING</p>
                </li>
                <li>
                    <img src="./images/i15.jpg" alt="">
                    <span>BILICHATA</span>
                    <p>DISCONNECTED</p>
                </li>
                <li>
                    <img src="./images/i15.jpg" alt="">
                    <span>BILICHATA</span>
                    <p>DISCONNECTED</p>
                </li>
                <li>
                    <img src="./images/i15.jpg" alt="">
                    <span>BILICHATA</span>
                    <p>CONNECTING</p>
                </li>
                <li>
                    <img src="./images/i15.jpg" alt="">
                    <span>BILICHATA</span>
                    <p>CONNECTING</p>
                </li>
                <li>
                    <img src="./images/i15.jpg" alt="">
                    <span>BILICHATA</span>
                    <p>CONNECTING</p>
                </li>
                <li>
                    <img src="./images/i15.jpg" alt="">
                    <span>BILICHATA</span>
                    <p>DISCONNECTED</p>
                </li>
                <li>
                    <img src="./images/i15.jpg" alt="">
                    <span>BILICHATA</span>
                    <p>DISCONNECTED</p>
                </li>
                <li>
                    <img src="./images/i15.jpg" alt="">
                    <span>BILICHATA</span>
                    <p>CONNECTING</p>
                </li>
                <li>
                    <img src="./images/i15.jpg" alt="">
                    <span>BILICHATA</span>
                    <p>CONNECTING</p>
                </li>
            </ul>
        </div>
    </div>
    <div class="xian">
        <img src="./images/i9.jpg" alt="">
    </div>
    <div class="index_six">
        <div class="index_six_l">
            <table>
                    
                </table>
        </div>
        <div class="index_six_r">
            <h2>JSON数据</h2>
            <p>
            </p>
            <p>  
            </p>
            <p>   
            </p>
            <p> 
            </p>
        </div>
    </div>
</div>
<!-- Wenjuan Layer Begin --> <div id="idy_floatdiv" style="position:fixed;display:flex;right:0;bottom:10%;width:30px;border-top-left-radius:6px;border-bottom-left-radius:6px;height:100px;background:#bba1cb;line-height: 24px;writing-mode:vertical-rl;align-items:center;justify-content:center;font-family:PingFangSC-Regular;font-size:16px;"> <a href="https://wj.qq.com/s2/21316811/c07c/" target="blank" style="color:#FFFFFF;text-decoration:none;"> 小偶像出道点 </a></div> <!-- Wenjuan Layer End -->
    <?php
    require 'footer.php'
    ?></div>
    </div>
   
    </div>
    <script src="./js/main.js"></script>
    <script src="./js/echarts.min.js"></script>
    <script>
        let mid = "";
    // 在页面加载完成后执行
document.addEventListener('DOMContentLoaded', function() {
    // 调用API获取数据
    fetch('https://api.vtbs.moe/v1/detail/1555453291')
        .then(response => response.json())
        .then(data => {
            console.log(data);
            
            // 基础信息填充
            document.querySelector('.index_top_l h2').textContent = data.uname;//名称
            document.querySelector('.index_top_l img').src = data.face;//个人图片
            // document.querySelector('.bgImg2 img').src = data.topPhoto;
            
            // 个人空间和直播间链接
            const spaceAnchors = document.querySelectorAll('.index_top_l_m a');
            spaceAnchors[0].href = `https://space.bilibili.com/${data.mid}`;
            spaceAnchors[0].querySelector('span').textContent = `https://space.bilibili.com/${data.mid}`;//个人空间
            mid = data.mid;
            
            spaceAnchors[1].href = `https://live.bilibili.com/${data.roomid}`;
            spaceAnchors[1].querySelector('span').textContent = `https://live.bilibili.com/${data.roomid}`;//直播间

            // 关注和视频数
            document.querySelector('.index_top_c_t .con p').textContent = data.follower.toLocaleString();//关注数
            document.querySelectorAll('.index_top_c_t .con p')[1].textContent = data.video;//视频数

            const guardRatio = data.guardNum > 0 
            ? `≈ ${Math.round(data.follower / data.guardNum).toLocaleString()}` 
            : 'N/A';
        document.querySelector('.jtbTitle').textContent = guardRatio;

            // 签名
            document.querySelector('.index_top_c_b_l p').textContent = data.sign;//签名

            // 舰团信息
            document.querySelector('.jtTitle').textContent = data.guardNum;//舰团

            // 直播信息
            document.querySelector('.zbjTitle').textContent = data.title;//直播间

            //Zeroroku by Jannchie见齐
            // document.querySelector('.midUrl').href = `https://zeroroku.com/bilibili/author/${data.mid}`;
            // document.querySelector('.midUrlCon').textContent = `https://zeroroku.com/bilibili/author/${data.mid}`;
            // JSON数据显示
            const jsonDataElements = document.querySelectorAll('.index_six_r p');
            jsonDataElements[0].innerHTML = `
                "info":<br>    
                "mid": ${data.mid}<br> 
                "uuid ":${data.uuid}<br> 
                "uname":${data.uname}<br> 
                "videc": ${data.video}<br> 
                "roomld":${data.roomid}<br> 
                "sign":${data.sign}<br> 
                "notice": ${data.notice}<br> 
                "face": ${data.face}<br> 
                "r1se":${data.rise}<br> 
                "topPhoto":${data.topPhoto}<br> 
                "archiveViem": ${data.archiveView}<br> 
                "follower":${data.follower}<br> 
                "liveStatus":${data.liveStatus}<br> 
                "recordNum":${data.recordNum}<br> 
                "guardNum":${data.guardNum}`;

                jsonDataElements[1].innerHTML = `"lastLive":<br>   
                "online": ${data.lastLive["online"]},<br>   
                "time":  ${data.lastLive["time"]},<br>   
                "guardChange": ${data.guardChange}<br>`;
                const guardTypeStr = Object.entries(data.guardType || {})
                .map(([key, value]) => `${key}: ${value}`)
                .join(',<br>');
                jsonDataElements[2].innerHTML = `
                "guardType":<br>   
                ${guardTypeStr}</br>`;
                jsonDataElements[3].innerHTML = `
                "online": ${data.online}<br>  
                "title": ${data.title}<br>  
                "time": ${data.time}<br>  
                "liveStartTime" :${data.liveStartTime}<br>`;
              // 填充详细数据表格
              const formatNumber = num => num.toLocaleString();

            // 创建表格结构
            const formatTimeAgo = timestamp => {
                if (!timestamp) return '从未直播';
                const diff = Date.now() - timestamp;
                const hours = Math.floor(diff / 3600000);
                
                if (hours >= 24) {
                    const days = Math.floor(hours / 24);
                    return `${days}天前`;
                }
                return hours > 0 ? `${hours}小时前` : '刚刚';
            };


            const table = document.querySelector('.index_six_l table');
            table.innerHTML = ''; // 清空现有内容

            const tableData = [
                // 表格结构配置
                { label: '名字', value: data.uname },
                {
                    label: '关注', 
                    value: `${data.follower.toLocaleString()} <span style="margin-left:60px;">(${(data.follower/10000).toFixed(1)}万)</span>`,
                    class: 'highlight' 
                },
                { label: '空间', value: data.mid, class: 'highlight colblue' },
                { label: '直播间', value: data.roomid, class: 'highlight colblue' },
                { 
                    label: '签名',
                    value: data.sign,
                    class: 'highlight' 
                },
                { label: '视频数', value: data.video, class: 'highlight' },
                { label: '直播标题', value: data.title || '暂无直播', class: 'highlight' },
                { label: '舰团', value: data.guardNum, class: 'highlight' },
                // { 
                //     label: '直播状态',
                //     value: data.liveStatus ? '直播中' : formatTimeAgo(data.lastLive["time"]),
                //     class: 'highlight' 
                // },
                { label: '公告', value: data.notice, class: 'highlight' },
                { 
                    label: '直播时长',
                    value: data.liveStartTime ? 
                        (() => {
                            const durationHours = Math.floor((Date.now() - data.liveStartTime)/3600000);
                            if (durationHours >= 24) {
                                const days = Math.floor(durationHours / 24);
                                const remainingHours = durationHours % 24;
                                return `${days}天${remainingHours > 0 ? `${remainingHours}小时` : ''}`;
                            }
                            return `${durationHours}小时`;
                        })() : 
                        'NaN时',
                    class: 'highlight' 
                },
                { label: '人气', value: data.online || 0, class: 'highlight' },
                { 
                    label: '上次更新',
                    value: formatTimeAgo(data.lastLive["time"]),
                    class: 'highlight' 
                }
            ];
                // console.log(tableData);
                
            // 生成表格
            tableData.forEach(item => {
                const row = document.createElement('tr');
                
                const th = document.createElement('th');
                th.textContent = item.label;
                row.appendChild(th);

                const td = document.createElement('td');
                td.className = item.class || '';
                td.innerHTML = item.value;
                
                row.appendChild(td);
                table.appendChild(row);
            });
            getTu2();
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });
    function getTu2(){
            const chartDom = document.getElementById('main1');
        const dateDisplayDom = document.getElementById('dateDisplay1');
        const myChart = echarts.init(chartDom);

        // 数据预处理
        const processData = (rawData) => {
            return rawData
                .map(item => ({
                    time: new Date(item.time),
                    guardNum: item.guardNum
                }))
                .sort((a, b) => a.time - b.time);
        };

        // 日期格式化
        const formatDate = (timestamp) => {
            const date = new Date(timestamp);
            return `${(date.getMonth()+1).toString().padStart(2,'0')}-${date.getDate().toString().padStart(2,'0')}`;
        };

        // 生成日期显示
        const generateDateDisplay = (startDate, endDate) => {
            const dateItems = [];
            const timeRange = endDate - startDate;
            const interval = timeRange / 4; // 分成5个等分点
            
            for (let i = 0; i < 5; i++) {
                const currentDate = new Date(startDate.getTime() + interval * i);
                dateItems.push({
                    time: currentDate,
                    formatted: formatDate(currentDate)
                });
            }
            return dateItems;
        };

        fetch('https://api.vtbs.moe/v2/bulkGuard/1555453291')
            .then(response => response.json())
            .then(rawData => {
                console.log(rawData);
                
                const allData = processData(rawData);
                const now = new Date();
                const oneMonthAgo = new Date(now - 30 * 24 * 3600 * 1000);
                const processedData = allData.filter(d => d.time >= oneMonthAgo);

                // 更新日期显示函数
                const updateDateDisplay = (startDate, endDate) => {
                    const dateItems = generateDateDisplay(startDate, endDate);
                    dateDisplayDom.innerHTML = dateItems.map(item => 
                        `<div class="date-item">${item.formatted}</div>`
                    ).join('');
                };

                // 初始化显示
                updateDateDisplay(oneMonthAgo, now);

                // 配置图表选项
                const option = {
                    tooltip: {
                        trigger: 'axis',
                        formatter: (params) => {
                            const date = formatDate(params[0].axisValue);
                            return `
                                <div style="
                                    background: #fff;
                                    padding: 12px;
                                    border-radius: 4px;
                                    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
                                    font-size: 14px;
                                ">
                                    <div style="color: #666; margin-bottom: 8px; font-weight: 500">
                                        ${date}
                                    </div>
                                    <div style="display: flex; align-items: center">
                                        <span style="
                                            display: inline-block;
                                            width: 10px;
                                            height: 10px;
                                            background: #19d4ae;
                                            border-radius: 50%;
                                            margin-right: 8px
                                        "></span>
                                        舰团: ${params[0].value[1]}
                                    </div>
                                </div>
                            `;
                        }
                    },
                    legend: {
                        data: ['舰团数量'],
                        top: 20,
                        itemGap: 25
                    },
                    grid: {
                        left: 60,
                        right: 60,
                        bottom: 80,
                        containLabel: true
                    },
                    xAxis: {
                        type: 'time',
                        min: oneMonthAgo,
                        max: now,
                        axisLabel: {
                            formatter: (value) => formatDate(value),
                            interval: 2 * 24 * 3600 * 1000
                        },
                        axisLine: {
                            lineStyle: {
                                color: '#ddd'
                            }
                        }
                    },
                    yAxis: {
                        type: 'value',
                        name: '舰团数量',
                        min: (value) => Math.floor(value.min / 10) * 10 - 10,
                        max: (value) => Math.ceil(value.max / 10) * 10 + 10,
                        interval: 10,
                        axisLabel: {
                            formatter: (value) => value.toFixed(0)
                        },
                        axisLine: {
                            lineStyle: {
                                color: '#19d4ae'
                            }
                        }
                    },
                    dataZoom: [{
                        type: 'slider',
                        start: 0,
                        end: 100,
                        bottom: 30,
                        height: 20,
                        handleSize: '100%',
                        fillerColor: 'rgba(25,212,174,0.1)',
                        borderColor: 'transparent',
                        dataBackground: {
                            lineStyle: {
                                color: '#19d4ae',
                                width: 0.5
                            }
                        }
                    }],
                    series: [{
                        name: '舰团',
                        type: 'line',
                        data: allData.map(d => [d.time, d.guardNum]),
                        smooth: true,
                        showSymbol: false,
                        lineStyle: {
                            width: 2,
                            color: '#19d4ae'
                        },
                        areaStyle: {
                            color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [
                                { offset: 0, color: 'rgba(25,212,174,0.3)' },
                                { offset: 1, color: 'rgba(25,212,174,0.05)' }
                            ])
                        }
                    }]
                };

                // 监听缩放事件
                myChart.on('dataZoom', params => {
                    const [start, end] = params.batch ? 
                        [params.batch[0].start, params.batch[0].end] : 
                        [params.start, params.end];
                    
                    const timeRange = allData[allData.length-1].time - allData[0].time;
                    const startTime = allData[0].time.getTime() + timeRange * start / 100;
                    const endTime = allData[0].time.getTime() + timeRange * end / 100;
                    
                    updateDateDisplay(new Date(startTime), new Date(endTime));
                });

                myChart.setOption(option);
                window.addEventListener('resize', () => myChart.resize());
            })
            .catch(error => {
                console.error('数据加载失败:', error);
                myChart.showLoading('error', {
                    text: '数据加载失败，请检查网络连接',
                    color: '#ff4d4f',
                    textColor: '#666',
                    maskColor: 'rgba(255,255,255,0.9)'
                });
            });
        }
        });
        </script>
        <script>
           let isAutoScrolling = false;
        let lastScrollTime = 0;
        let animationFrameId = null;

        window.addEventListener('wheel', async (e) => {
        // 只在向下滚动且页面顶部可见时触发
        if (e.deltaY > 0 && 
            window.scrollY <= 50 &&  
            !isAutoScrolling &&
            Date.now() - lastScrollTime > 300) {
            
            const bgImg2 = document.querySelector('.bgImg2');
            if (!bgImg2) return; 
            
            if (animationFrameId) {
            cancelAnimationFrame(animationFrameId);
            }

            isAutoScrolling = true;
            lastScrollTime = Date.now();

            const targetPosition = Math.floor(
            bgImg2.getBoundingClientRect().top + window.pageYOffset
            );
            
            if (Math.abs(window.scrollY - targetPosition) < 50) return;

            const startPosition = window.pageYOffset;
            const distance = targetPosition - startPosition;
            const duration = Math.min(800, Math.abs(distance) * 0.8);

            const startTime = performance.now();
            
            const animateScroll = (currentTime) => {
            const elapsed = currentTime - startTime;
            const progress = Math.min(elapsed / duration, 1);
            const easeProgress = 0.5 * (1 - Math.cos(Math.PI * progress));

            window.scrollTo(0, startPosition + distance * easeProgress);

            if (progress < 1) {
                animationFrameId = requestAnimationFrame(animateScroll);
            } else {
                isAutoScrolling = false;
                animationFrameId = null;
            }
            };

            animationFrameId = requestAnimationFrame(animateScroll);
        }
        });
</script>

<script>
//关注历史
        const initChart = async () => {
            const chartDom = document.getElementById('main');
            const loadingDom = chartDom.querySelector('.loading-overlay');
            const myChart = echarts.init(chartDom);

            try {
                // 显示加载状态
                loadingDom.style.display = 'flex';

                // 获取数据
                const response = await fetch('https://api.vtbs.moe/v2/bulkActive/1555453291');
                if (!response.ok) throw new Error(`HTTP错误 ${response.status}`);
                
                const rawData = await response.json();
                if (!Array.isArray(rawData)) throw new Error('无效数据格式');

                // 处理数据
                const processedData = rawData
                    .map((item, index) => {
                        if (!item.time || !item.follower) {
                            console.warn(`无效数据项[${index}]被过滤`);
                            return null;
                        }
                        return {
                            time: new Date(item.time),
                            follower: Number(item.follower),
                            increment: 0
                        };
                    })
                    .filter(Boolean)
                    .sort((a, b) => a.time - b.time)
                    .map((d, i, arr) => {
                        if (i === 0) return d;
                        const prev = arr[i-1];
                        const hours = (d.time - prev.time) / 3600000;
                        d.increment = Number(((d.follower - prev.follower)/hours)).toFixed(2);
                        return d;
                    });

                // 配置图表
                const option = {
                    animationDuration: 1000,
                    tooltip: {
                        trigger: 'axis',
                        backgroundColor: 'rgba(255,255,255,0.95)',
                        borderWidth: 0,
                        textStyle: { color: '#333' },
                        formatter: params => {
                            const date = params[0].axisValueLabel;
                            const follower = params[0].value[1].toLocaleString();
                            const increment = params[1].value[1];
                            return `
                                <div style="padding: 12px; border-radius: 4px;">
                                    <div style="font-weight: bold; margin-bottom: 8px;">${date}</div>
                                    <div style="display: flex; align-items: center; margin-bottom: 6px;">
                                        <span style="display: inline-block; width: 10px; height: 10px; border-radius: 50%; background: #5470c6; margin-right: 8px;"></span>
                                        关注数: ${follower}
                                    </div>
                                    <div style="display: flex; align-items: center;">
                                        <span style="display: inline-block; width: 10px; height: 10px; border-radius: 50%; background: #91cc75; margin-right: 8px;"></span>
                                        增量: ${increment >= 0 ? '+' : ''}${increment}/h
                                    </div>
                                </div>
                            `;
                        }
                    },
                    xAxis: {
                        type: 'time',
                        boundaryGap: false,
                        axisLabel: {
                            formatter: '{MM}-{dd}'
                        }
                    },
                    yAxis: [
                        {
                            type: 'value',
                            name: '关注数',
                            axisLine: { lineStyle: { color: '#5470c6' } },
                            splitLine: { show: false }
                        },
                        {
                            type: 'value',
                            name: '小时增量',
                            axisLine: { lineStyle: { color: '#91cc75' } },
                            splitLine: { show: false }
                        }
                    ],
                    dataZoom: [{
                        type: 'slider',
                        bottom: 20,
                        height: 30,
                        handleStyle: {
                            color: '#5470c6',
                            shadowBlur: 6,
                            shadowColor: 'rgba(84,112,198,0.3)'
                        }
                    }],
                    series: [
                        {
                            name: '关注数',
                            type: 'line',
                            data: processedData.map(d => [d.time, d.follower]),
                            smooth: true,
                            symbol: 'none',
                            lineStyle: { width: 2 },
                            areaStyle: {
                                color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [
                                    { offset: 0, color: 'rgba(84,112,198,0.3)' },
                                    { offset: 1, color: 'rgba(84,112,198,0.01)' }
                                ])
                            }
                        },
                        {
                            name: '增量',
                            yAxisIndex: 1,
                            type: 'line',
                            data: processedData.map(d => [d.time, d.increment]),
                            smooth: true,
                            symbol: 'none',
                            lineStyle: {
                                color: '#91cc75',
                                type: 'dashed'
                            }
                        }
                    ]
                };

                // 渲染图表
                myChart.setOption(option);
                loadingDom.style.display = 'none';

                // 自适应调整
                window.addEventListener('resize', () => {
                    myChart.resize();
                    loadingDom.style.width = chartDom.offsetWidth + 'px';
                    loadingDom.style.height = chartDom.offsetHeight + 'px';
                });

            } catch (error) {
                console.error('完整错误:', error);
                loadingDom.innerHTML = `
                    <div style="text-align: center;">
                        <div style="color: #ff4d4f; margin-bottom: 10px;">加载失败: ${error.message}</div>
                        <button onclick="location.reload()" 
                            style="padding: 8px 16px; 
                                   background: #5470c6; 
                                   color: white; 
                                   border: none; 
                                   border-radius: 4px; 
                                   cursor: pointer;">
                            点击重试
                        </button>
                    </div>
                `;
            }
        };

        // 启动初始化
        document.addEventListener('DOMContentLoaded', initChart);
    </script>
    
    <script>
    //舰团
        document.addEventListener('DOMContentLoaded', () => {
            const chartDom = document.getElementById('guardChart');
            const loadingDom = chartDom.querySelector('.loading-mask');
            const myChart = echarts.init(chartDom);

            // 显示初始加载状态
            myChart.showLoading({
                text: '正在加载舰团数据...',
                color: '#19d4ae',
                textColor: '#606266',
                maskColor: 'rgba(255,255,255,0.9)'
            });

            fetch('https://api.vtbs.moe/v2/bulkGuard/1555453291')
                .then(response => {
                    if (!response.ok) throw new Error(`HTTP错误 ${response.status}`);
                    return response.json();
                })
                .then(rawData => {
                    // 数据预处理
                    const processData = (data) => {
                        return data
                            .map(item => ({
                                time: new Date(item.time),
                                guardNum: item.guardNum
                            }))
                            .sort((a, b) => a.time - b.time)
                            .filter(d => !isNaN(d.time.getTime()))
                    };

                    const validData = processData(rawData);
                    
                    // 时间范围设置（最近30天）
                    const now = new Date();
                    const startDate = new Date(now.setDate(now.getDate() - 30));

                    const option = {
                        tooltip: {
                            trigger: 'axis',
                            backgroundColor: 'rgba(25,212,174,0.95)',
                            borderWidth: 0,
                            textStyle: {
                                color: '#fff',
                                fontSize: 14
                            },
                            formatter: (params) => {
                                const date = params[0].axisValue;
                                const guardNum = params[0].value[1];
                                return `
                                    ${echarts.time.format(date, '{MM}-{dd}', false)}<br>
                                    <span style="display:inline-block;margin:2px 5px 0 0;border-radius:50%;width:10px;height:10px;background-color:#fff;"></span>
                                    舰团: ${guardNum}
                                `;
                            }
                        },
                        grid: {
                            left: 60,
                            right: 30,
                            bottom: 40,
                            top: 30
                        },
                        xAxis: {
                            type: 'time',
                            boundaryGap: false,
                            axisLabel: {
                                color: '#909399',
                                formatter: (value) => {
                                    return echarts.time.format(value, '{MM}-{dd}', false);
                                }
                            },
                            splitLine: {
                                show: true,
                                lineStyle: {
                                    color: '#ebeef5',
                                    type: 'dashed'
                                }
                            }
                        },
                        yAxis: {
                            type: 'value',
                            name: '舰团数量',
                            axisLine: {
                                lineStyle: {
                                    color: '#19d4ae'
                                }
                            },
                            splitLine: {
                                lineStyle: {
                                    color: '#ebeef5'
                                }
                            }
                        },
                        dataZoom: [{
                            type: 'slider',
                            bottom: 10,
                            height: 20,
                            handleSize: 14,
                            handleStyle: {
                                color: '#19d4ae',
                                shadowBlur: 6,
                                shadowColor: 'rgba(25,212,174,0.3)'
                            },
                            fillerColor: 'rgba(25,212,174,0.1)'
                        }],
                        series: [{
                            type: 'line',
                            name: '舰团数量',
                            data: validData.map(d => [d.time, d.guardNum]),
                            smooth: true,
                            symbol: 'none',
                            lineStyle: {
                                color: '#19d4ae',
                                width: 2
                            },
                            areaStyle: {
                                color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [
                                    { offset: 0, color: 'rgba(25,212,174,0.3)' },
                                    { offset: 1, color: 'rgba(25,212,174,0.01)' }
                                ])
                            }
                        }]
                    };

                    myChart.setOption(option);
                    myChart.hideLoading();
                    loadingDom.style.display = 'none';

                    // 窗口自适应
                    window.addEventListener('resize', () => myChart.resize());
                })
                .catch(error => {
                    console.error('数据加载失败:', error);
                    loadingDom.innerHTML = `
                        <div style="text-align:center;color:#f56c6c;">
                            <div style="margin-bottom:10px;">数据加载失败</div>
                            <button onclick="location.reload()" 
                                style="padding:6px 12px;
                                       background:#19d4ae;
                                       color:#fff;
                                       border:none;
                                       border-radius:4px;
                                       cursor:pointer;">
                                点击重试
                            </button>
                        </div>
                    `;
                    myChart.hideLoading();
                });
        });
    </script>
    <script src="./js/main.js"></script>
</body>
</html>