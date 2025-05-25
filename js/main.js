
        document.addEventListener('DOMContentLoaded', function() {
            const bannerImg = document.querySelector('body');
            let currentBanner = 0;

            // 预加载所有图片
            const preloadImages = () => {
                for (let i = 1; i <= 6; i++) {
                    new Image().src = `./images/banner${i}.jpg`;
                }
            };
            preloadImages();

            // 智能随机算法（确保不重复）
            const getNextBanner = () => {
                const candidates = [1,2,3,4,5,6].filter(n => n !== currentBanner);
                return candidates[Math.floor(Math.random() * candidates.length)];
            };

            // 优化后的切换函数
            const changeBanner = () => {
                const newBanner = getNextBanner();
                
                // 先设置新背景再执行过渡
                bannerImg.style.backgroundImage = `url('./images/banner${newBanner}.jpg')`;
                // bannerImg.style.opacity = 1;
                
                currentBanner = newBanner;
            };

            // 初始化首个随机背景
            currentBanner = getNextBanner();
            bannerImg.style.backgroundImage = `url('./images/banner${currentBanner}.jpg')`;

            // 启动定时器
            setInterval(() => {
                // 先触发淡出
                // bannerImg.style.opacity = 0;
                
                // 在过渡结束后切换图片
                setTimeout(changeBanner, 1000); // 与过渡时间保持一致
            }, 2000);
        });