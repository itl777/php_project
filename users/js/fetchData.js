const fetchData = function (url, data = {}) {
  let options = {};
  if (Object.keys(data).length !== 0) {
    options = { method: "POST", body: JSON.stringify(data) };
  }
  return fetch(url, options).then((r) => r.json());
};
