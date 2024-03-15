var express = require("express");
var cors = require("cors");
const bodyParser = require("body-parser");

var app = express();
const { PrismaClient } = require("@prisma/client");
const prisma = new PrismaClient();

app.use(bodyParser.json());
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

// Create a task
app.post("/tasks", async (req, res) => {
  const { title, completed } = req.body;
  console.log(req.body);
  try {
    const task = await prisma.task.create({
      data: {
        title,
        completed,
      },
    });
    res.json(task);
  } catch (error) {
    res.status(500).json({ error: "Unable to create task" });
  }
});

// Get all tasks
app.get("/tasks", async (req, res) => {
  try {
    const tasks = await prisma.task.findMany();
    console.log("here", tasks);
    res.json(tasks);
  } catch (error) {
    res.status(500).json({ error: "Unable to fetch tasks" });
  }
});

// Get a single task by ID
app.get("/tasks/:id", async (req, res) => {
  const { id } = req.params;
  try {
    const task = await prisma.task.findUnique({
      where: {
        id: parseInt(id),
      },
    });
    if (!task) {
      return res.status(404).json({ error: "Task not found" });
    }
    res.json(task);
  } catch (error) {
    res.status(500).json({ error: "Unable to fetch task" });
  }
});

// Update a task
app.put("/tasks/:id", async (req, res) => {
  const { id } = req.params;
  const { title, completed } = req.body;
  try {
    const updatedTask = await prisma.task.update({
      where: {
        id: parseInt(id),
      },
      data: {
        title,
        completed,
      },
    });
    res.json(updatedTask);
  } catch (error) {
    res.status(500).json({ error: "Unable to update task" });
  }
});

// Delete a task
app.delete("/tasks/:id", async (req, res) => {
  const { id } = req.params;
  try {
    await prisma.task.delete({
      where: {
        id: parseInt(id),
      },
    });
    res.json({ message: "Task deleted successfully" });
  } catch (error) {
    res.status(500).json({ error: "Unable to delete task" });
  }
});

const PORT = process.env.PORT || 3000;

app.listen(PORT, () => {
  console.log(`Server is running: http://localhost:${PORT}`);
});
