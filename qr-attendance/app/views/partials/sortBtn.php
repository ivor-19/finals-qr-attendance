<body>
    <form action="">
        <button class = "lastWeekBtn">Last Week</button>
    </form>
    <form action="<?= ROOT ?>/home/yesterday" method="POST">
        <button type = "submit" class = "yesterdayBtn" name="attendyesterday">Yesterday</button>
    </form>
    <form action="<?= ROOT ?>/home" method="POST">
        <button class = "todayBtn">Today</button>
    </form>

    <script>
        /*
        const lastWeekBtn = document.querySelector('.lastWeekBtn');
        const yesterdayBtn = document.querySelector('.yesterdayBtn');
        const todayBtn = document.querySelector('.todayBtn');

        lastWeekBtn.addEventListener('click', function(){
        lastWeekBtn.style.background = '#8200FF';
        lastWeekBtn.style.color = '#fff';
        yesterdayBtn.style.background = '#F2EAFD';
        yesterdayBtn.style.color = '#9253C3';
        todayBtn.style.background = '#F2EAFD';
        todayBtn.style.color = '#9253C3';
        });
        yesterdayBtn.addEventListener('click', function(){
        lastWeekBtn.style.background = '#F2EAFD';
        lastWeekBtn.style.color = '#9253C3';
        yesterdayBtn.style.background = '#8200FF';
        yesterdayBtn.style.color = '#fff';
        todayBtn.style.background = '#F2EAFD';
        todayBtn.style.color = '#9253C3';
        });
        todayBtn.addEventListener('click', function(){
        lastWeekBtn.style.background = '#F2EAFD';
        lastWeekBtn.style.color = '#9253C3';
        yesterdayBtn.style.background = '#F2EAFD';
        yesterdayBtn.style.color = '#9253C3';
        todayBtn.style.background = '#8200FF';
        todayBtn.style.color = '#fff';
        });
        */
    </script>
</body>
