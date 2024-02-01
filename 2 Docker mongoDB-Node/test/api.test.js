const chai = require("chai");
const chaiHttp = require("chai-http");
const app = require("../server");
const Item = require("../models/itemModel");

chai.use(chaiHttp);
const expect = chai.expect;

// Clear the database before running tests
before(async () => {
  await Item.deleteMany({});
});

describe("API Tests", () => {
  // Test data
  const testData = {
    name: "Test Item",
  };

  it("should create a new item", async () => {
    const res = await chai.request(app).post("/items").send(testData);

    expect(res).to.have.status(200);
    expect(res.body).to.be.a("object");
    expect(res.body).to.have.property("name").eq(testData.name);
  });

  it("should get all items", async () => {
    const res = await chai.request(app).get("/items");

    expect(res).to.have.status(200);
    expect(res.body).to.be.an("array");
    expect(res.body.length).to.be.gte(1);
  });

  it("should update an item", async () => {
    const newItem = new Item({ name: "Update Test Item" });
    await newItem.save();

    const updateData = { name: "Updated Item" };
    const res = await chai
      .request(app)
      .put(`/items/${newItem._id}`)
      .send(updateData);

    expect(res).to.have.status(200);
    expect(res.body).to.be.a("object");
    expect(res.body).to.have.property("name").eq(updateData.name);
  });

  it("should delete an item", async () => {
    const newItem = new Item({ name: "Delete Test Item" });
    await newItem.save();

    const res = await chai.request(app).delete(`/items/${newItem._id}`);

    expect(res).to.have.status(200);
    expect(res.body).to.be.a("object");
    expect(res.body)
      .to.have.property("message")
      .eq("Item deleted successfully");
  });
});
