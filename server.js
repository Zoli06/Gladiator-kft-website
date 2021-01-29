var http = require("http");
var fs = require("fs");

function getMIME(url) {
  var index = url.lastIndexOf(".");
  var mime = "text/" + url.slice(index + 1, url.lenght);
  return mime;
}

function onRequest(request, response) {
    response.writeHead(200, { "Content-Type": getMIME(request.url) });
    fs.readFile(__dirname + "/public" + request.url, null, function (error, data) {
      //we can't use relative path :-(
      if (error) {
        response.writeHead(404);
        response.write("File not found");
        console.log(error);
      } else {
        response.write(data);
      }
      response.end();
    });
}

http.createServer(onRequest).listen(5000);

console.log("The server is running...");
