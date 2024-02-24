# Pet 寵物領養

## 專案簡介

這是一個基於 Laravel 8 的 Pet 寵物領養專案。專案旨在提供一個簡單而完整的 API 來管理寵物的領養，並提供使用者註冊、登入、登出等身份驗證功能。

## 安裝方式

1. 克隆專案到本地端。

    ```bash
    git clone https://github.com/wai-imyen/pet.git
    ```

2. 進入專案目錄。

    ```bash
    cd pet
    ```

3. 安裝相依套件。

    ```bash
    composer install
    ```

4. 複製 `.env.example` 並命名為 `.env`，並設定資料庫等相關配置。

    ```bash
    cp .env.example .env
    ```

5. 生成 Laravel 金鑰。

    ```bash
    php artisan key:generate
    ```

6. 遷移資料庫。

    ```bash
    php artisan migrate
    ```

7. 啟動內建伺服器。

    ```bash
    php artisan serve
    ```

8. 專案將運行在 `http://localhost:8000`。

## API 路由

### Pet 相關 API

- 取得所有寵物

    ```
    GET /pet
    ```

- 取得特定寵物詳細資訊

    ```
    GET /pet/{id}
    ```

- 新增寵物

    ```
    POST /pet
    ```

- 更新特定寵物資訊

    ```
    PUT /pet/{id}
    ```

- 刪除特定寵物

    ```
    DELETE /pet/{id}
    ```

- 將寵物加入願望清單

    ```
    POST /pet/{id}/wishlist
    ```

### 使用者相關 API

- 使用者登入

    ```
    POST /user/login
    ```

- 使用者註冊

    ```
    POST /user/register
    ```

- 刷新身份驗證 Token

    ```
    POST /user/refresh
    ```

- 使用者登出

    ```
    POST /user/logout
    ```

- 取得目前登入使用者資訊

    ```
    GET /user/me
    ```

## 注意事項

- 請確保您的伺服器環境符合 Laravel 8 的系統需求。

- 請根據專案需求調整相對應的設定，如資料庫連線、身份驗證中間件等。
