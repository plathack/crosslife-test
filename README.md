Эндпоинты проекта:
==================
1. [GET] - /api/catalog - вывести список всех товаров
2. [POST] - /api/create-order - Создание заказа, пример body: 
{
  "status": "Not approved",
  "user_id": 1,
  "products": [
    {
      "id": 1,
      "count": 3
    },
    {
      "id":3,
      "count": 2
    }
    ]
}
3. [POST] - /api/approve-order - Подтверждение заказа, пример body:
{
  "user_id": 1,
  "order_id": 1
}
