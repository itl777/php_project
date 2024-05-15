const quickAdd = function(pageNow){
  let url = `../database/fake-data/fake-data-users.php`;
  fetchJsonData(url).then(data => {
    console.log(data);
    pageChange(pageNow);
  })
}