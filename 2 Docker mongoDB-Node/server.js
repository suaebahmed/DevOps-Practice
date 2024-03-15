var express = require("express");
var cors = require("cors");
const bodyParser = require("body-parser");
const Item = require("./models/itemModel");
const mongoose = require("mongoose");

const PORT = process.env.PORT || 3001;
var app = express();
app.use(cors());
// app.options("*", cors());
// app.use(function (req, res, next) {
//   res.header("Access-Control-Allow-Origin", "*");
//   res.header(
//     "Access-Control-Allow-Headers",
//     "Origin, X-Requested-With, Content-Type, Accept"
//   );
//   next();
// });
app.use(bodyParser.json());

// Read
app.get("/", (req, res, next) => {
  res.send("Hello World, I am from docker compose!!");
});

app.get("/:message", (req, res) => {
  console.log(req.params.message);
  res.send("echo: " + req.params.message);
});

app.get("/items", async (req, res) => {
  const items = await Item.find();
  res.json(items);
});

// Update
app.put("/items/:id", async (req, res) => {
  const updatedItem = await Item.findByIdAndUpdate(req.params.id, req.body, {
    new: true,
  });
  res.json(updatedItem);
});

// Delete
app.delete("/items/:id", async (req, res) => {
  const item = await Item.findByIdAndDelete(req.params.id);
  res.json({ message: "Item deleted successfully" });
});

app.listen(PORT, () => {
  console.log(`Server is running on: http://localhost:${PORT}`);
});

module.exports = app;
