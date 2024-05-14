

var DateDiff = function (sDate2) {
    var oDate1 = new Date();
    var oDate2 = new Date(sDate2);
    var iDays = parseInt(Math.abs(oDate1 - oDate2) / 1000 / 60 / 60 / 24);
    return iDays;
};

// 因為將此js引入至add-coupon，檔案位置變為該檔案，因此路徑要更改
fetch('coupon/holiday.json')
    .then(r => r.json())
    .then(data => {
        data.forEach(element => {
            let GetDateDiff1 = DateDiff(element['Start Date']); // 轉換為天數 

            if (GetDateDiff1 < 30) {
                if (element['Subject'] !== "例假日") {
                    console.log(element['Subject']);
                    document.getElementById('holiday').innerText = element['Subject'];
                    return
                }
            }
        });

    })





