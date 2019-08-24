# Database Interface Layer of Tutorial System

## Description 

Database Interface Layer is governing input and output process of database communication from any other micro services. In this abstraction layer, this repository will provide the API for communication with the following tables: 

- content-category (master table)
- content-metadata (transactional table with one of the foreign key comes from content-category table)

As the result of this service, the Input and Output query into content-category and content-metadata tables will be provided as rest APIs.

See Red highlight below for the scope of this repository.

![RESTAPI.jpg](images/Content_Manager_highlight.png)

## API END POINT
* v1 : http://example.com/v1

## API Docs
* https://dbil.docs.apiary.io/

## API DB Diagram
- [x] [Sprint 1](https://dbdiagram.io/d/5d28c8f8ced98361d6dc9bab)
- [x] [Sprint 2](https://dbdiagram.io/d/5d2edb4fced98361d6dcbc9f)
- [ ] [Spirnt 2 (Refactoring)][https://dbdiagram.io/d/5d60b65bced98361d6dddf7b] [We Are Here Now]

## Table Structure API End Points

### Content Metadata Table Routes
| URL                                      | Method | INFO                    |
| ---------------------------------------- | ------ | ----------------------- |
| `content/metadata`                       | GET    | Get All Data            |
| `content/metadata/store`                 | POST   | Save Data               |
| `content/metadata/{id}`                  | GET    | Get Data by ID          |
| `content/metadata/search`                | POST   | Search Data Query       |
| `content/metadata/update/{id}`           | POST   | Update Data by ID       |
| `content/metadata/delete/{id}`           | POST   | Delete Data by ID       |

### Content Table Routes
| URL                                      | Method | INFO                    |
| ---------------------------------------- | ------ | ----------------------- |
| `content/subtitle`                       | GET    | Get All Data            |
| `content/subtitle/store`                 | POST   | Save Data               |
| `content/subtitle/{id}`                  | GET    | Get Data by ID          |
| `content/subtitle/search`                | POST   | Search Data Query       |
| `content/subtitle/update/{id}`           | POST   | Update Data by ID       |
| `content/subtitle/delete/{id}`           | POST   | Delete Data by ID       |
| `content/category`                       | GET    | Get All Data            |
| `content/category/store`                 | POST   | Save Data               |
| `content/category/{id}`                  | GET    | Get Data by ID          |
| `content/category/search`                | POST   | Search Data Query       |
| `content/category/update/{id}`           | POST   | Update Data by ID       |
| `content/category/delete/{id}`           | POST   | Delete Data by ID       |
| `content/playlists/category`             | GET    | Get All Data            |
| `content/playlists/category/store`       | POST   | Save Data               |
| `content/playlists/category/{id}`        | GET    | Get Data by ID          |
| `content/playlists/category/search`      | POST   | Search Data Query       |
| `content/playlists/category/update/{id}` | POST   | Update Data by ID       |
| `content/playlists/category/delete/{id}` | POST   | Delete Data by ID       |

### User Table Routes
| URL                                      | Method | INFO                    |
| ---------------------------------------- | ------ | ----------------------- |
| `user`                                   | GET    | Get All Data            |
| `user/store`                             | POST   | Save Data               |
| `user/{id}`                              | GET    | Get Data by ID          |
| `user/search`                            | POST   | Search Data Query       |
| `user/update/{id}`                       | POST   | Update Data by ID       |
| `user/delete/{id}`                       | POST   | Delete Data by ID       |

## Example screen shots of API invocations

![RESTAPI.jpg](images/Selection_01283.png)

![RESTAPI.jpg](images/Selection_01284.png)

![RESTAPI.jpg](images/Selection_01285.png)

![RESTAPI.jpg](images/Selection_01286.png)

![RESTAPI.jpg](images/Selection_01287.png)

![RESTAPI.jpg](images/Selection_01290.png)

![RESTAPI.jpg](images/Selection_01291.png)


## How to commit

When committing, precommit hook been called and expect tests and linting be passed first

### Commit message [Conventional Commits](https://conventionalcommits.org/).

The commit message should be structured as follows:

---

```bash
<squad abbreviation-ticket number> <type>(<scope>):  <description>
<BLANK LINE>
[optional body]
<BLANK LINE>
[optional footer]
```

---

## Examples

### Commit message with description, scope and breaking change in body

```bash
CM-21 feat(dbid): allow provided config object to extend other configs

CM-22 BREAKING CHANGE(dbid): redirect old API request service page to new version
```

### Revert

If the commit reverts a previous commit, it should begin with `revert:`, followed by the header of the reverted commit. In the body it should say: `This reverts commit <hash>.`, where the hash is the SHA of the commit being reverted.

### Type

Must be one of the following:

| type            | usage                                                                                                                                                                 |
| :-------------- | :-------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| fix             | A bug fix (this correlates with [PATCH](http://semver.org/#summary) in semantic versioning).                                                                          |
| feat            | A new feature (this correlates with [MINOR](http://semver.org/#summary) in semantic versioning).                                                                      |
| BREAKING CHANGE | introduces a breaking API change (correlating with [MAJOR](http://semver.org/#summary) in semantic versioning). A breaking change can be part of commits of any type. |
| chore           | bau taks                                                                                                                                                              |
| build           | Changes that affect the build system or external dependencies (example scopes: gulp, broccoli, npm, webpack)                                                          |
| ci              | Changes to our CI configuration files and scripts (example scopes: Travis, Circle, BrowserStack, SauceLabs)                                                           |
| docs            | Documentation only changes                                                                                                                                            |
| perf            | A code change that improves performance                                                                                                                               |
| refactor        | A code change that neither fixes a bug nor adds a feature                                                                                                             |
| style           | Changes that do not affect the meaning of the code (white-space, formatting, missing semi-colons, etc)                                                                |
| test            | Adding missing tests or correcting existing tests                                                                                                                     |

### Scope

The scope should be the name of the component package affected (as perceived by the person reading the changelog generated from commit messages.

The following is the list of supported scopes:

| Short Code | Components               |
| :--------- | :----------------------- |
| dbid       | Database Interface Layer |
| test       | Test automation          |
| doc        | Documentation            |
... keep adding above list
