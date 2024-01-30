var express = require("express");
var cors = require("cors");
var app = express();
app.use(cors());
app.options("*", cors());

app.use(function (req, res, next) {
  res.header("Access-Control-Allow-Origin", "*");
  res.header(
    "Access-Control-Allow-Headers",
    "Origin, X-Requested-With, Content-Type, Accept"
  );
  next();
});

app.get("/", (req, res, next) => {
  res.send("Hello World, I am learning Docker!");
});

app.get("/:message", (req, res) => {
  console.log(req.params.message);
  res.send("echo: " + req.params.message);
});

app.listen(3000, () => {
  console.log("V2 Server running on port 3000: http://localhost:3000/");
});
