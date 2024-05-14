const fetchJsonData = function (url, data = {}) {
  let options = {};
  if (Object.keys(data).length !== 0) {
    options = {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(data)
    }
  }
  return fetch(url, options).then((r) => r.json());
};
