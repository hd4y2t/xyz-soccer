# XYZ Soccer API Documentation

## Authentication

All endpoints require an API key in the `Authorization` header:

```
Authorization: Bearer YOUR_API_KEY
```

---

## Endpoints

### 1. Register

-   **URL:** `api/register`
-   **Method:** `POST`
-   **Description:** `register user`.
-   **Request:**
    ```json
    {
        "name": "user1", // string
        "email": "user1@example.com", //string
        "password": "user123" //string
    }
    ```
-   **Response:**
    ```json
    {
        "message": "Registration successful.",
        "token": "2|nqu8IL5EM176I8cNIjsIllNXcQGmvxFeOhvJJkftbbe5f13a",
        "token_type": "Bearer",
        "user": {
            "name": "user1",
            "email": "user1@example.com",
            "updated_at": "2025-07-30T16:17:16.000000Z",
            "created_at": "2025-07-30T16:17:16.000000Z",
            "id": 2
        }
    }
    ```

---

### 2. Login

-   **URL:** `api/login`
-   **Method:** `POST`
-   **Description:** `login user`.
-   **Request:**
    ```json
    {
        "email": "admin@example.com", //string
        "password": "admin123" //string
    }
    ```
-   **Response:**
    ```json
    {
        "message": "Login successful.",
        "token": "1|rkA3sxd7QylFYluaPQc5YL5qLIbVw2nlhYuTWz1g5825b69b",
        "token_type": "Bearer",
        "user": {
            "id": 1,
            "name": "admin",
            "email": "admin@example.com",
            "email_verified_at": "2025-07-30 10:34:35",
            "created_at": "2025-07-30T10:34:35.000000Z",
            "updated_at": "2025-07-30T10:34:35.000000Z",
            "deleted_at": null
        }
    }
    ```

---

---

### 3. Logout

-   **URL:** `api/logout`
-   **Method:** `POST`
-   **Description:** `logout user`.
-   **Response:**
    ```json
    {
        "message": "Login successful.",
        "token": "1|rkA3sxd7QylFYluaPQc5YL5qLIbVw2nlhYuTWz1g5825b69b",
        "token_type": "Bearer",
        "user": {
            "id": 1,
            "name": "admin",
            "email": "admin@example.com",
            "email_verified_at": "2025-07-30 10:34:35",
            "created_at": "2025-07-30T10:34:35.000000Z",
            "updated_at": "2025-07-30T10:34:35.000000Z",
            "deleted_at": null
        }
    }
    ```

---

### 4. Get All Team

-   **URL:** `api/team`
-   **Method:** `GET`
-   **Description:** Get All Team.
-   **Response:**
    ```json
    {
        "message": "Get Data successfully.",
        "data": [
            {
                "id": 1,
                "name": "A",
                "logo": "team_68898574dc3fb.jpg",
                "founded_year": "2000",
                "home_address": "D",
                "city": "C",
                "created_at": "2025-07-30T02:37:40.000000Z",
                "updated_at": "2025-07-30T02:37:40.000000Z",
                "deleted_at": null,
                "logo_url": "http://127.0.0.1:8000/storage/teams/team_68898574dc3fb.jpg",
                "players": [
                    {
                        "id": 1,
                        "team_id": 1,
                        "name": "D",
                        "height": 180,
                        "weight": 78,
                        "position": "penyerang",
                        "shirt_number": 2,
                        "created_at": "2025-07-30T02:39:32.000000Z",
                        "updated_at": "2025-07-30T02:39:32.000000Z",
                        "deleted_at": null
                    },
                    {
                        "id": 2,
                        "team_id": 1,
                        "name": "E",
                        "height": 180,
                        "weight": 78,
                        "position": "penyerang",
                        "shirt_number": 3,
                        "created_at": "2025-07-30T02:41:07.000000Z",
                        "updated_at": "2025-07-30T02:41:07.000000Z",
                        "deleted_at": null
                    }
                ]
            }
        ]
    }
    ```

---

### 3. Show Team

-   **URL:** `api/teams/{team}`
-   **Method:** `GET`
-   **Description:** Show a teams by id.
-   **Parameters:**
    -   `team` (integer): Team ID
-   **Response:**
    ```json
    {
        "message": "Team retrieved successfully.",
        "data": {
            "id": 1,
            "name": "A",
            "logo": "team_6889f55bc2c7f.jpg",
            "founded_year": "2000",
            "home_address": "D",
            "city": "C",
            "created_at": "2025-07-30T10:35:07.000000Z",
            "updated_at": "2025-07-30T10:35:07.000000Z",
            "deleted_at": null,
            "logo_url": "http://127.0.0.1:8000/storage/teams/team_6889f55bc2c7f.jpg",
            "players": [
                //list player
                {
                    "id": 2,
                    "team_id": 1,
                    "name": "GHwaw",
                    "height": 180,
                    "weight": 78,
                    "position": "penyerang",
                    "shirt_number": 2,
                    "created_at": "2025-07-30T10:35:24.000000Z",
                    "updated_at": "2025-07-30T10:35:24.000000Z",
                    "deleted_at": null
                },
                {
                    "id": 1,
                    "team_id": 1,
                    "name": "GHwaw",
                    "height": 180,
                    "weight": 78,
                    "position": "penyerang",
                    "shirt_number": 20,
                    "created_at": "2025-07-30T10:35:21.000000Z",
                    "updated_at": "2025-07-30T10:35:21.000000Z",
                    "deleted_at": null
                }
            ]
        }
    }
    ```

---

### 4. Create Team

-   **URL:** `api/teams`
-   **Method:** `POST`
-   **Description:** Create a new team.
-   **Body:**

    -   `name` (string, required)
    -   `coach` (string, required)
    -   `city` (string, required)
    -   `logo` (UploadedFile, required)
    -   `founded_year` (integer, `min:1800`, required)
    -   `home_address` (string, required)
    -   `country` (string, required)

-   **Response:**

    ```json
    {
        "message": "team created successfully.",
        "data": {
            "name": "B",
            "logo": "team_6889f562cb4a7.jpg",
            "founded_year": "2000",
            "home_address": "D",
            "city": "C",
            "updated_at": "2025-07-30T10:35:14.000000Z",
            "created_at": "2025-07-30T10:35:14.000000Z",
            "id": 2,
            "logo_url": "http://127.0.0.1:8000/storage/teams/team_6889f562cb4a7.jpg"
        }
    }
    ```

---

### 4. Update Team

-   **URL:** `api/teams/{team}`
-   **Method:** `PUT`
-   **Description:** Update data team.
-   **Parameter:**
    -   `team` (string, required) Team ID
-   **Body:**
    -   `name` (string, required)
    -   `coach` (string, required)
    -   `city` (string, required)
    -   `logo` (`UploadedFile`, required)
    -   `founded_year` (integer, `min:1800`, required)
    -   `home_address` (string, required)
    -   `country` (string, required)
-   **Response:**
    ```json
    {
        "message": "team created successfully.",
        "data": {
            "name": "B",
            "logo": "team_6889f562cb4a7.jpg",
            "founded_year": "2000",
            "home_address": "D",
            "city": "C",
            "updated_at": "2025-07-30T10:35:14.000000Z",
            "created_at": "2025-07-30T10:35:14.000000Z",
            "id": 2,
            "logo_url": "http://127.0.0.1:8000/storage/teams/team_6889f562cb4a7.jpg"
        }
    }
    ```

---

### 5. Delete Team

-   **URL:** `api/teams/{team}`
-   **Method:** `DELETE`
-   **Description:** Delete data team.
-   **Parameter:**
    -   `team` (string, required) Team ID
-   **Response:**
    ```json
    {
        "message": "Team deleted successfully."
    }
    ```

---

### 6. Get Player by Team

-   **URL:** `api/teams/{team}/players`
-   **Method:** `GET`
-   **Description:** Get Player by team.
-   **Parameter:**
    -   `team` (string, required) Team ID
-   **Response:**
    ```json
    {
        "message": "Get Data successfully.",
        "data": [
            {
                "id": 2,
                "team_id": 1,
                "name": "A",
                "height": 180,
                "weight": 78,
                "position": "penyerang",
                "shirt_number": 2,
                "created_at": "2025-07-30T10:35:24.000000Z",
                "updated_at": "2025-07-30T10:35:24.000000Z",
                "deleted_at": null
            },
            {
                "id": 1,
                "team_id": 1,
                "name": "B",
                "height": 180,
                "weight": 78,
                "position": "penyerang",
                "shirt_number": 20,
                "created_at": "2025-07-30T10:35:21.000000Z",
                "updated_at": "2025-07-30T10:35:21.000000Z",
                "deleted_at": null
            }
        ]
    }
    ```

---

### 7. Create Player

-   **URL:** `api/teams/{team}/players`
-   **Method:** `POST`
-   **Description:** Create Player for team.
-   **Parameter:**
    -   `team` (string, required) Team ID
-   **Body**

    -   `name` (string, required)
    -   `height` (integer, required)
    -   `weight` (integer, required)
    -   `position` (string, integer, `enum['penyerang','gelandang','bertahan','penjaga gawang']`)
    -   `shirt_number` (int, uniq on team)

-   **Response:**
    ```json
    {
        "message": "Player created successfully.",
        "data": {
            "name": "A",
            "position": "penyerang",
            "shirt_number": "231",
            "height": "180",
            "weight": "78",
            "team_id": 2,
            "updated_at": "2025-07-31T03:32:14.000000Z",
            "created_at": "2025-07-31T03:32:14.000000Z",
            "id": 4
        }
    }
    ```

---

### 8. Update Player

-   **URL:** `api/teams/{team}/players/{player}`
-   **Method:** `PUT`
-   **Description:** Update data player.
-   **Parameter:**
    -   `team` (string, required) Team ID
    -   `player` (string, required) Player ID
-   **Body**

    -   `name` (string, required)
    -   `height` (integer, required)
    -   `weight` (integer, required)
    -   `position` (string, integer, `enum['penyerang','gelandang','bertahan','penjaga gawang']`)
    -   `shirt_number` (int, uniq on team)

-   **Response:**
    ```json
    {
        "message": "Player updated successfully.",
        "data": {
            "id": 4,
            "team_id": 2,
            "name": "ABC",
            "height": 180,
            "weight": 78,
            "position": "penyerang",
            "shirt_number": 2,
            "created_at": "2025-07-31T03:32:14.000000Z",
            "updated_at": "2025-07-31T03:35:39.000000Z",
            "deleted_at": null
        }
    }
    ```

---

### 9. Delete Player

-   **URL:** `api/teams/{team}/players/{player}`
-   **Method:** `DELETE`
-   **Description:** Delete Player from team.
-   **Parameter:**
    -   `team` (string, required) Team ID
    -   `player` (string, required) Player ID
-   **Response:**
    ```json
    {
        "message": "Player deleted successfully."
    }
    ```

---

### 10. Get All Tournament

-   **URL:** `api/tournaments`
-   **Method:** `GET`
-   **Description:** Get All Tournament.
-   **Response:**
    ```json
    {
        "message": "Get Data successfully.",
        "data": [
            {
                "id": 1,
                "home_team_id": 2,
                "away_team_id": 1,
                "tournament_date": "2025-08-09",
                "tournament_time": "10:10:00",
                "status": "completed", // 'scheduled','completed'
                "created_at": "2025-07-30T10:35:46.000000Z",
                "updated_at": "2025-07-30T10:52:34.000000Z",
                "deleted_at": null,
                "home_team": {
                    "id": 2,
                    "name": "B",
                    "logo": "team_6889f562cb4a7.jpg",
                    "founded_year": "2000",
                    "home_address": "D",
                    "city": "C",
                    "created_at": "2025-07-30T10:35:14.000000Z",
                    "updated_at": "2025-07-30T10:35:14.000000Z",
                    "deleted_at": null,
                    "logo_url": "http://127.0.0.1:8000/storage/teams/team_6889f562cb4a7.jpg"
                },
                "away_team": {
                    "id": 1,
                    "name": "A",
                    "logo": "team_6889f55bc2c7f.jpg",
                    "founded_year": "2000",
                    "home_address": "D",
                    "city": "C",
                    "created_at": "2025-07-30T10:35:07.000000Z",
                    "updated_at": "2025-07-30T10:35:07.000000Z",
                    "deleted_at": null,
                    "logo_url": "http://127.0.0.1:8000/storage/teams/team_6889f55bc2c7f.jpg"
                },
                "result": {
                    // hasil result tournament
                    "id": 3,
                    "tournament_id": 1,
                    "home_score": 1,
                    "away_score": 4,
                    "status": "Tim Away Menang.",
                    "created_at": "2025-07-30T10:53:27.000000Z",
                    "updated_at": "2025-07-30T10:53:27.000000Z",
                    "deleted_at": null
                }
            }
        ]
    }
    ```

---

### 10. Create Tournament

-   **URL:** `api/tournaments`
-   **Method:** `POST`
-   **Description:** Create a new tournament.
-   **Body**

    -   `home_team_id` (integer, required) Team ID
    -   `away_team_id` (integer, required) Team ID
    -   `tournament_date` (date, required, `format_date:'Y-m-d'`)
    -   `tournament_time` (date, required, `format_date:'H:s:i'`)

-   **Response:**
    ```json
    {
        "message": "Get Data successfully.",
        "data": [
            {
                "id": 1,
                "home_team_id": 2,
                "away_team_id": 1,
                "tournament_date": "2025-08-09",
                "tournament_time": "10:10:00",
                "status": "scheduled", //status tournament
                "created_at": "2025-07-30T10:35:46.000000Z",
                "updated_at": "2025-07-30T10:52:34.000000Z",
                "deleted_at": null,
                "home_team": {
                    "id": 2,
                    "name": "B",
                    "logo": "team_6889f562cb4a7.jpg",
                    "founded_year": "2000",
                    "home_address": "D",
                    "city": "C",
                    "created_at": "2025-07-30T10:35:14.000000Z",
                    "updated_at": "2025-07-30T10:35:14.000000Z",
                    "deleted_at": null,
                    "logo_url": "http://127.0.0.1:8000/storage/teams/team_6889f562cb4a7.jpg"
                },
                "away_team": {
                    "id": 1,
                    "name": "A",
                    "logo": "team_6889f55bc2c7f.jpg",
                    "founded_year": "2000",
                    "home_address": "D",
                    "city": "C",
                    "created_at": "2025-07-30T10:35:07.000000Z",
                    "updated_at": "2025-07-30T10:35:07.000000Z",
                    "deleted_at": null,
                    "logo_url": "http://127.0.0.1:8000/storage/teams/team_6889f55bc2c7f.jpg"
                }
            }
        ]
    }
    ```

---

### 11. Show Tournament

-   **URL:** `api/tournaments/{tournamnet}`
-   **Method:** `GET`
-   **Description:** show detail a tournament.
-   **Parameter:**
    -   `tournament` (string, required) Tournament ID
-   **Body**

    -   `home_team_id` (integer, required) Team ID
    -   `away_team_id` (integer, required) Team ID
    -   `tournament_date` (date, required, `format_date:'Y-m-d'`)
    -   `tournament_time` (date, required, `format_date:'H:s:i'`)

-   **Response:**
    ```json
    {
        "id": 1,
        "home_team_id": 2,
        "away_team_id": 1,
        "tournament_date": "2025-08-09",
        "tournament_time": "10:10:00",
        "status": "completed", // ['scheduled' ,'completed']
        "created_at": "2025-07-30T10:35:46.000000Z",
        "updated_at": "2025-07-30T10:52:34.000000Z",
        "deleted_at": null,
        "home_team": {
            "id": 2,
            "name": "B",
            "logo": "team_6889f562cb4a7.jpg",
            "founded_year": "2000",
            "home_address": "D",
            "city": "C",
            "created_at": "2025-07-30T10:35:14.000000Z",
            "updated_at": "2025-07-30T10:35:14.000000Z",
            "deleted_at": null,
            "logo_url": "http://127.0.0.1:8000/storage/teams/team_6889f562cb4a7.jpg"
        },
        "away_team": {
            "id": 1,
            "name": "A",
            "logo": "team_6889f55bc2c7f.jpg",
            "founded_year": "2000",
            "home_address": "D",
            "city": "C",
            "created_at": "2025-07-30T10:35:07.000000Z",
            "updated_at": "2025-07-30T10:35:07.000000Z",
            "deleted_at": null,
            "logo_url": "http://127.0.0.1:8000/storage/teams/team_6889f55bc2c7f.jpg"
        },
        "result": {
            "id": 3,
            "tournament_id": 1,
            "home_score": 1,
            "away_score": 4,
            "status": "Tim Away Menang.", // ['Tim Away Menang, Tim Home Menang, Draw]
            "created_at": "2025-07-30T10:53:27.000000Z",
            "updated_at": "2025-07-30T10:53:27.000000Z",
            "deleted_at": null
        },
        "goals": [
            {
                "id": 41,
                "tournament_id": 1,
                "player_id": 1,
                "goal_time": "10:12:00",
                "created_at": "2025-07-30T10:53:27.000000Z",
                "updated_at": "2025-07-30T10:53:27.000000Z",
                "deleted_at": null,
                "player": {
                    // player
                    "id": 1,
                    "team_id": 1,
                    "name": "GHwaw",
                    "height": 180,
                    "weight": 78,
                    "position": "penyerang",
                    "shirt_number": 20,
                    "created_at": "2025-07-30T10:35:21.000000Z",
                    "updated_at": "2025-07-30T10:35:21.000000Z",
                    "deleted_at": null,
                    "team": {
                        // from team
                        "id": 1,
                        "name": "A",
                        "logo": "team_6889f55bc2c7f.jpg",
                        "founded_year": "2000",
                        "home_address": "D",
                        "city": "C",
                        "created_at": "2025-07-30T10:35:07.000000Z",
                        "updated_at": "2025-07-30T10:35:07.000000Z",
                        "deleted_at": null,
                        "logo_url": "http://127.0.0.1:8000/storage/teams/team_6889f55bc2c7f.jpg"
                    }
                }
            }
        ]
    }
    ```

---

### 12. Delete Tournamnet

-   **URL:** `api/tournaments/{tournament}`
-   **Method:** `DELETE`
-   **Description:** Delete Tournament.
-   **Parameter:**
    -   `tournament` (string, required) Team ID
-   **Response:**

    ```json
    {
        "message": "tournament deleted successfully."
    }
    ```

-   **Response if tournament status completed**

    ```json
    {
        "message": "Failed to delete tournament.",
        "error": "Cannot delete a tournament that has already been played."
    }
    ```

---

### 13. Result Tournamnet

-   **URL:** `api/tournaments/{tournament}/result`
-   **Method:** `POST`
-   **Description:** create result a Tournament.
-   **Parameter:**
    -   `tournament` (string, required) Team ID
-   **Body**

    -   `goals` (array, required)
    -   `goals.*.player_id` (integer, required) Player ID
    -   `goals.*.goal_time` (date, `format_date: 's:i'`, required)

-   **Example body**

    ```json
    {
        "goals": [
            {
                "player_id": 1,
                "goal_time": "10:12"
            },
            {
                "player_id": 2,
                "goal_time": "20:00"
            }
        ]
    }
    ```

-   **Response:**

    ```json
    {
        "message": "Tournament result successfully recorded.",
        "data": {
            "status": "Tim Away Menang.",
            "home_score": 1,
            "away_score": 4
        }
    }
    ```

---

### 14. Report Tournamnet

-   **URL:** `api/tournaments/{tournament}/report`
-   **Method:** `GET`
-   **Description:** Report from Tournament.
-   **Parameter:**

    -   `tournament` (string, required) Team ID

-   **Response:**

    ```json
    {
        "message": "Laporan hasil pertandingan berhasil diambil.",
        "data": {
            "tournament": {
                "id": 1,
                "home_team_id": 2,
                "away_team_id": 1,
                "tournament_date": "2025-08-09",
                "tournament_time": "10:10:00",
                "status": "completed",
                "created_at": "2025-07-30T10:35:46.000000Z",
                "updated_at": "2025-07-30T10:52:34.000000Z",
                "deleted_at": null,
                "result": {
                    "id": 3,
                    "tournament_id": 1,
                    "home_score": 1,
                    "away_score": 4,
                    "status": "Tim Away Menang.",
                    "created_at": "2025-07-30T10:53:27.000000Z",
                    "updated_at": "2025-07-30T10:53:27.000000Z",
                    "deleted_at": null
                }
            },
            "skor_akhir": "1 - 4",
            "status_pertandingan": "Tim Away Menang.",
            "top_scorer": {
                "nama": "A",
                "jumlah_gol": 4
            },
            "akumulasi_kemenangan": {
                "tim_home": 1,
                "tim_away": 4
            }
        }
    }
    ```
