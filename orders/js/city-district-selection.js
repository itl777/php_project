document.addEventListener("DOMContentLoaded", function () {
  const citySelect = document.getElementById("city");

  // fetch 城市
  fetch("api/get-city-api.php")
    .then((response) => response.json())
    .then((data) => {
      data.forEach((city) => {
        // 設定 option 顯示的文字與 value
        let option = new Option(city.city_name, city.id);
        citySelect.add(option);
      });
    });

  // 監聽城市選擇變化
  citySelect.addEventListener("change", function () {
    updateDistrictOptions(this.value, null)
  });


});


// 更新縣市區域選項
function updateDistrictOptions (cityId, districtIdToSelect) {
  
  const districtSelect = document.getElementById("district");

  districtSelect.innerHTML = "<option selected>請選擇</option>";
  
    if (cityId) {
      fetch(`api/get-district-api.php?cityId=${cityId}`)
      .then((response) => response.json())
      .then((data) => {
        data.forEach((district) => {
          let option = new Option(district.district_name, district.id);
          districtSelect.add(option);
        });

        if (districtIdToSelect) {
          // 設定初始區域選擇
          districtSelect.value = districtIdToSelect;
        }
      })
      .catch(error => console.error('載入縣市區失敗：', error));
    }
}
