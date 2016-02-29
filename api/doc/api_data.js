define({ "api": [
  {
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "optional": false,
            "field": "varname1",
            "description": "<p>No type.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "varname2",
            "description": "<p>With type.</p>"
          }
        ]
      }
    },
    "type": "",
    "url": "",
    "version": "0.0.0",
    "filename": "./doc/main.js",
    "group": "E__Workspace_league_history_api_doc_main_js",
    "groupTitle": "E__Workspace_league_history_api_doc_main_js",
    "name": ""
  },
  {
    "type": "delete",
    "url": "/champions/:id",
    "title": "Delete the champion with ID",
    "name": "DeleteChampion",
    "version": "1.0.0",
    "filename": "./routes/champions.php",
    "group": "E__Workspace_league_history_api_routes_champions_php",
    "groupTitle": "E__Workspace_league_history_api_routes_champions_php"
  },
  {
    "type": "get",
    "url": "/champions/:id",
    "title": "Get the champion with the provided id",
    "name": "GetChampion",
    "version": "1.0.0",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "champion",
            "description": "<p>Champion infos</p>"
          }
        ]
      }
    },
    "filename": "./routes/champions.php",
    "group": "E__Workspace_league_history_api_routes_champions_php",
    "groupTitle": "E__Workspace_league_history_api_routes_champions_php"
  },
  {
    "type": "get",
    "url": "/champions",
    "title": "Get a list of all champions",
    "name": "GetChampions",
    "version": "1.0.0",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "champions",
            "description": "<p>List of champions</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "    HTTP/1.1 200 OK\n    [{\n      \"name\": \"John\",\n      \"slug\": \"Doe\",\n      \"games\": 0,\n      \"wins\": 0,\n      \"bans\": 0\n    },\n\t   {\n      \"name\": \"John\",\n      \"slug\": \"Doe\",\n      \"games\": 0,\n      \"wins\": 0,\n      \"bans\": 0\n    }]",
          "type": "json"
        }
      ]
    },
    "filename": "./routes/champions.php",
    "group": "E__Workspace_league_history_api_routes_champions_php",
    "groupTitle": "E__Workspace_league_history_api_routes_champions_php"
  },
  {
    "type": "post",
    "url": "/champions",
    "title": "Create a new champion",
    "name": "PostChampion",
    "version": "1.0.0",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "champion",
            "description": "<p>Champion created</p>"
          }
        ]
      }
    },
    "filename": "./routes/champions.php",
    "group": "E__Workspace_league_history_api_routes_champions_php",
    "groupTitle": "E__Workspace_league_history_api_routes_champions_php"
  },
  {
    "type": "get",
    "url": "/champions/search/:query",
    "title": "Search for a champion with query",
    "name": "QueryChampion",
    "version": "1.0.0",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "champion",
            "description": "<p>Champion found</p>"
          }
        ]
      }
    },
    "filename": "./routes/champions.php",
    "group": "E__Workspace_league_history_api_routes_champions_php",
    "groupTitle": "E__Workspace_league_history_api_routes_champions_php"
  },
  {
    "type": "put",
    "url": "/champions/:id",
    "title": "Updates the champion with ID",
    "name": "UpdateChampion",
    "version": "1.0.0",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "champion",
            "description": "<p>Champion updated</p>"
          }
        ]
      }
    },
    "filename": "./routes/champions.php",
    "group": "E__Workspace_league_history_api_routes_champions_php",
    "groupTitle": "E__Workspace_league_history_api_routes_champions_php"
  }
] });
