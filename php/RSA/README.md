# PHP RSA 加密\解密

## 操作演示：

```bash
[vagrant@localhost RSA]$ php example.php

# 执行 php example.php 命令后得到如下结果
========================= 私钥加密&公钥解密 =========================
字符串(Hello World.)私钥加密后：h4VKLeRC7H5YltiN54VWgKts/FDTYOw3T+LIyJclc+NJLFbi5T/GCH6XC2soOkzzCPvE7xdUE8Fcpj25tdQ+LWz6L2PfdMXJqHNU2qb9oGoqr0yQiNKqWEyPMUZay4JrMHP4Y6nFg253S0fYaRT1Cvwv6Gq5s+LU6Li6AgH/N9g=
加密字符串(h4VKLeRC7H5YltiN54VWgKts/FDTYOw3T+LIyJclc+NJLFbi5T/GCH6XC2soOkzzCPvE7xdUE8Fcpj25tdQ+LWz6L2PfdMXJqHNU2qb9oGoqr0yQiNKqWEyPMUZay4JrMHP4Y6nFg253S0fYaRT1Cvwv6Gq5s+LU6Li6AgH/N9g=)公钥解密后：Hello World.

========================= 公钥加密&私钥解密 =========================
字符串(世界，你好。)公钥加密后：cmi7ZcfOk2ofzn4QC7hFjRUCC8hT9MshtiaNBATd/NkzH/yzy5PGrwiO3mSgOGYbXSTqoj/OBsdWzzDGwBHA66i5EQt5kxLZiuLky34/Nmf+j+M3mb+0YuJASCgiiyh2BG8oKhluuDWf68pl65z4uN9SbgBr76qCEu89bbmTikE=
加密字符串(cmi7ZcfOk2ofzn4QC7hFjRUCC8hT9MshtiaNBATd/NkzH/yzy5PGrwiO3mSgOGYbXSTqoj/OBsdWzzDGwBHA66i5EQt5kxLZiuLky34/Nmf+j+M3mb+0YuJASCgiiyh2BG8oKhluuDWf68pl65z4uN9SbgBr76qCEu89bbmTikE=)私钥解密后：世界，你好。

========================= sha1WithRSAEncryption =========================
字符串(Hello World.)私钥加密后：cBCL8Kt2x4Kce8gLOMWU809C7rh2RJu9sLbHelnOa1q1XC7bCJ0oxtVrz9RypoAyBQ5ki6c27wKDUId0gcr6VR14yQxEi16KPEzh03SYcIYzEJd7J8BdknZ0oYS0zcsgbg4DOBj9ydQSjJJz/lbRbyy1in13MAlyMdPfPHSYalo=
sha1WithRSAEncryption 加密验证成功

========================= sha256WithRSAEncryption =========================
字符串(Hello World.)私钥加密后：JiTYLJNOyHkcs1ogBkxoCIf7zAKIVc0YbjqHcFD+YN9q2ZBK1J1sNxGazT+eGTtEI49NtDc/SPglF0OgdYlH1h7II9r18E3mjZuqpxJhlAIPgRr8AnmKA04RXkNy3WHUKb21bw23ZAlJsmRNuNdELSgz5xjIvP3q7I48yYiMrOU=
sha256WithRSAEncryption 加密验证成功

========================= sha512WithRSAEncryption =========================
字符串(Hello World.)私钥加密后：wgXuhfI+zsBkLteOOHPznhPsJJgpQf3amAvaWifkNai0QUeCrW0rxpKGno7rH8tWWd+joMKwFrriOGv7s01zeDaJWBoIDGWnDSW+pGH3yaOV2AvMCFKJSSgvkM3oAr8eLq4HFI4J+BPSGtgoOUKb6egTw6IYbmU8A+XCWyxPavQ=
sha512WithRSAEncryption 加密验证成功

```