import http from 'k6/http';
import { check, sleep } from 'k6';
import { randomItem } from 'https://jslib.k6.io/k6-utils/1.2.0/index.js';

export const options = {
    vus: 5, // concurrent users
    duration: '10s', // test duration
};

const API_URL = 'http://127.0.0.1:8080/api/products/create'; // change if your API endpoint is different
const TOKEN = '1|q5IFdOXq9Lgz9oBp6gSiKzKMo5HwSdD3Q2TI1U4jcbd535fd'; // replace with a valid token

export default function () {
    // Sample data
    const categories = [1,2,3]; // change according to your DB
    const subcategories = [1,2,3];
    const brands = [1,2,3];
    const vendor_id = 1; // assign a valid vendor id from DB

    const payload = JSON.stringify({
        vendor_id: vendor_id,
        name: 'Test Product ' + Math.floor(Math.random()*1000),
        sku: 'SKU-' + Math.random().toString(36).substring(2,8).toUpperCase(),
        category_id: randomItem(categories),
        subcategory_id: randomItem(subcategories),
        brand_id: randomItem(brands),
        price: Math.floor(Math.random() * 1000) + 100,
        discount_price: Math.floor(Math.random() * 500),
        stock_quantity: Math.floor(Math.random() * 50) + 5,
        min_stock: 5,
        summary: 'This is a test product',
        description: 'Detailed description for test product',
        is_active: true
    });

    const params = {
        headers: {
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${TOKEN}`,
        },
    };

    const res = http.post(API_URL, payload, params);

    check(res, {
        'status is 200': (r) => r.status === 200 || r.status === 201,
        'product created': (r) => r.json('id') !== undefined,
    });

    console.log(res.body);

    sleep(1);
}

// run : k6 run create_product_test.js