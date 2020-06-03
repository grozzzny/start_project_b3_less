<?php

use yii\db\Migration;

/**
 * Class m200603_100158_office_init
 */
class m200603_100158_office_init extends Migration
{
    public $engine = 'ENGINE=InnoDB DEFAULT CHARSET=utf8';

    public function up()
    {
        /**
         * Пользователи аккаунтов с определенными правами
         */
        $this->createTable('office_users', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(), // Пользователь
            'account_id' => $this->integer(), // Привязка к аккаунту
            'role' => $this->string(), // Роль пользователя. guest assistant lawyer partner administrator
            'priority' => $this->string()->defaultValue(0),
        ], $this->engine);
        $this->createIndex('index_user_id_account_id', 'office_users', ['user_id', 'account_id'], true);

        /**
         * Главный аккаунт
         */
        $this->createTable('office_account', [
            'id' => $this->primaryKey(),
            'owner_id' => $this->integer(), // Владелец аккаунтом

            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ], $this->engine);

        /**
         * Клиенты
         */
        $this->createTable('office_clients', [
            'id' => $this->primaryKey(),
            'account_id' => $this->integer(), // Привязка к аккаунту
            'user_id' => $this->integer(), // Пользователь
            'full_name' => $this->string(), // ФИО
            'phone' => $this->string(), // Телефон
            'date_of_birth' => $this->string(), // Дата рождения
            'place_of_birth' => $this->string(), // Место рождения
            'place_registration' => $this->string(), // Место регистрации
            'place_residence' => $this->string(), // Место жительство
            'passport_number' => $this->string(), // Серия и номер паспорта
            'passport_date' => $this->string(), // Дата выдачи паспорта
            'passport_institution' => $this->string(), // Орган выдачи паспорта
            'passport_photo' => $this->string(), // Фото паспорта
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ], $this->engine);

        /**
         * Консультации
         */
        $this->createTable('office_consultation', [
            'id' => $this->primaryKey(),
            'account_id' => $this->integer(), // Привязка к аккаунту
            'user_id' => $this->integer(), // Пользователь
            'client_id' => $this->integer(), // Клиент
            'cost' => $this->string(), // Сумма консультации
            'type' => $this->string(), // Тип консультации: oral written
            'curator_id' => $this->integer(), // Куратор из сотрудников

            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ], $this->engine);

        $this->createTable('office_consultation_employee_rel', [
            'consultation_id' => $this->integer(),
            'employee_id' => $this->integer(),
        ], $this->engine);

        // Связи

        /**
         * Сотрудники
         */
        $this->createTable('office_employee', [
            'id' => $this->primaryKey(),
            'account_id' => $this->integer(), // Привязка к аккаунту

            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ], $this->engine);

        /**
         * Дела
         */
        $this->createTable('office_case', [
            'id' => $this->primaryKey(),
            'account_id' => $this->integer(), // Привязка к аккаунту
            'user_id' => $this->integer(), // Пользователь
            'number' => $this->integer(), // Номер дела
            'client_id' => $this->integer(), // Клиент
            'category' => $this->integer(), // Категория
            'object_category' => $this->integer(), // Объект категории
            'curator_id' => $this->integer(), // Куратор из сотрудников
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ], $this->engine);

        $this->createTable('office_case_employee_rel', [
            'case_id' => $this->integer(),
            'employee_id' => $this->integer(),
        ], $this->engine);

        /**
         * Задачи
         */
        $this->createTable('office_tasks', [
            'id' => $this->primaryKey(),
            'account_id' => $this->integer(), // Привязка к аккаунту
            'user_id' => $this->integer(), // Пользователь
            'curator_id' => $this->integer(), // Куратор из сотрудников
            'case_id' => $this->integer(), // Дело
            'client_id' => $this->integer(), // Автоматически! Клиент
            'description' => $this->text(), // Описание
            'time_to' => $this->text(), // Срок задачи
            'type_priority' => $this->text(), // Приоритет задачи. current important urgent
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ], $this->engine);

        $this->createTable('office_tasks_employee_rel', [
            'task_id' => $this->integer(),
            'employee_id' => $this->integer(),
        ], $this->engine);

        /**
         * Документы
         */
        $this->createTable('office_documents', [
            'id' => $this->primaryKey(),
            'account_id' => $this->integer(), // Привязка к аккаунту
            'user_id' => $this->integer(), // Пользователь
            'case_id' => $this->integer(), // Дело
            'client_id' => $this->integer(), // Клиент
            'category' => $this->integer(), // Категория. Текущие, Судебный акт, Документы
            'datetime_act' => $this->string(), // Дата судебного акта
            'category_act' => $this->string(), // Категория акта. Решение, приговор, постановление и т.д.
            'name' => $this->string(), // Наименование
            'file' => $this->string(), // Файл pdf
            'note' => $this->string(), // Примечание
            'court_id' => $this->integer(), // Суд
            'term_appeal' => $this->integer(), // Срок обжалования
            'result' => $this->integer(), // Результат
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ], $this->engine);

        /**
         * Заседания
         */
        $this->createTable('office_session', [
            'id' => $this->primaryKey(),
            'account_id' => $this->integer(), // Привязка к аккаунту
            'user_id' => $this->integer(), // Пользователь
            'case_id' => $this->integer(), // Дело
            'client_id' => $this->integer(), // Клиент
            'datetime_act' => $this->string(), // Дата и время заседания
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ], $this->engine);

        /**
         * Корреспонденция
         */
        $this->createTable('office_correspondence', [
            'id' => $this->primaryKey(),
            'account_id' => $this->integer(), // Привязка к аккаунту
            'user_id' => $this->integer(), // Пользователь
            'case_id' => $this->integer(), // Дело
            'client_id' => $this->integer(), // Клиент
            'employee_id' => $this->integer(), // Сотрудник
            'name_to' => $this->integer(), // Сотрудник
            'sender' => $this->integer(), // Отправитель
            'recipient' => $this->integer(), // Получатель
            'description' => $this->integer(), // Краткое содержание
            'mail_number' => $this->integer(), // Почтовый идентификатор
            'cost' => $this->integer(), // Сумма
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ], $this->engine);

        /**
         * Доп. примечения
         */
        $this->createTable('office_comments', [
            'id' => $this->primaryKey(),
            'task_id' => $this->integer(), // Задача
            'case_id' => $this->integer(), // Дело
            'client_id' => $this->integer(), // Клиент
            'document_id' => $this->integer(), // Документ
            'user_id' => $this->integer(), // Пользователь
            'text' => $this->integer(), // Описание
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ], $this->engine);

        /**
         * Транзацкция по делу
         */
        $this->createTable('office_transaction', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(), // Пользователь
            'cost' => $this->integer(), // Сумма
            'type' => $this->integer(), // Пополнение, списание
            'note' => $this->integer(), // Примечание
            'consultation_id' => $this->integer(), // Консультация
            'case_id' => $this->integer(), // Дело
            'client_id' => $this->integer(), // Клиент

            // Если списание:
            'is_account' => $this->boolean(), // Списание в пользу общего счета
            'employee_id' => $this->string(), // Сотруднику

            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ], $this->engine);

        /**
         * Транзацкции по общему счету
         */
        $this->createTable('office_account', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(), // Пользователь
            'cost' => $this->integer(), // Сумма
            'type' => $this->integer(), // Пополнение, списание
            'note' => $this->integer(), // Примечание

            // Если списание:
            'target' => $this->integer(), // Назначение платежа / Кому

            // Если пополение:
            'transaction_id' => $this->integer(), // Транзакция

            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ], $this->engine);

        /**
         * Суды
         */
        $this->createTable('office_courts', [
            'id' => $this->primaryKey(),
            'name' => $this->integer(), // Наименование суда
            'address' => $this->integer(), // Адрес
            'phone' => $this->integer(), // Телефон
        ], $this->engine);

    }

    public function down()
    {
        echo "m200603_100158_office_init cannot be reverted.\n";

        return false;
    }
}
