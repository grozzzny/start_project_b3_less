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
        $this->createTable('office_employee', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(), // Пользователь
            'account_id' => $this->integer(), // Привязка к аккаунту
            'role' => $this->string(), // Роль пользователя. guest assistant lawyer partner administrator
            'priority' => $this->integer()->defaultValue(0),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ], $this->engine);
        $this->createIndex('index_user_id_account_id', 'office_employee', ['user_id', 'account_id'], true);

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
        $this->createIndex('i_account_id', 'office_clients', 'account_id');

        /**
         * Консультации
         */
        $this->createTable('office_consultation', [
            'id' => $this->primaryKey(),
            'account_id' => $this->integer(), // Привязка к аккаунту
            'client_id' => $this->integer(), // Клиент
            'cost' => $this->integer(), // Сумма консультации
            'type' => $this->string(), // Тип консультации: oral written
            'curator_id' => $this->integer(), // Куратор из сотрудников
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ], $this->engine);

        $this->createIndex('i_account_id', 'office_consultation', 'account_id');
        $this->createIndex('i_client_id', 'office_consultation', 'client_id');

        $this->createTable('office_consultation_employee_rel', [
            'consultation_id' => $this->integer(),
            'employee_id' => $this->integer(),
        ], $this->engine);

        $this->createIndex('unique_consultation_employee', 'office_consultation_employee_rel', ['consultation_id','employee_id'], true);
        $this->addForeignKey('fk_consultation_rel', '{{%office_consultation_employee_rel}}', 'consultation_id', '{{%office_consultation}}', 'id', 'CASCADE');
        $this->addForeignKey('fk_employee_rel', '{{%office_consultation_employee_rel}}', 'employee_id', '{{%office_employee}}', 'id', 'CASCADE');

        /**
         * Дела
         */
        $this->createTable('office_case', [
            'id' => $this->primaryKey(),
            'account_id' => $this->integer(), // Привязка к аккаунту
            'number' => $this->string(), // Номер дела
            'client_id' => $this->integer(), // Клиент
            'category' => $this->string(), // Категория
            'object_category' => $this->string(), // Объект категории
            'curator_id' => $this->integer(), // Куратор из сотрудников
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ], $this->engine);

        $this->createIndex('i_account_id', 'office_case', 'account_id');
        $this->createIndex('i_client_id', 'office_case', 'client_id');

        $this->createTable('office_case_employee_rel', [
            'case_id' => $this->integer(),
            'employee_id' => $this->integer(),
        ], $this->engine);

        $this->createIndex('unique_case_employee', 'office_case_employee_rel', ['case_id','employee_id'], true);
        $this->addForeignKey('fk_case_rel', '{{%office_case_employee_rel}}', 'case_id', '{{%office_case}}', 'id', 'CASCADE');
        $this->addForeignKey('fk_employee_rel_2', '{{%office_case_employee_rel}}', 'employee_id', '{{%office_employee}}', 'id', 'CASCADE');

        /**
         * Задачи
         */
        $this->createTable('office_tasks', [
            'id' => $this->primaryKey(),
            'account_id' => $this->integer(), // Привязка к аккаунту
            'curator_id' => $this->integer(), // Куратор из сотрудников
            'case_id' => $this->integer(), // Дело
            'client_id' => $this->integer(), // Автоматически! Клиент
            'description' => $this->text(), // Описание
            'time_to' => $this->integer(), // Срок задачи
            'type_priority' => $this->string(), // Приоритет задачи. current important urgent
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ], $this->engine);

        $this->createIndex('i_account_id', 'office_tasks', 'account_id');
        $this->createIndex('i_client_id', 'office_tasks', 'client_id');
        $this->createIndex('i_curator_id', 'office_tasks', 'curator_id');
        $this->createIndex('i_case_id', 'office_tasks', 'case_id');

        $this->createTable('office_tasks_employee_rel', [
            'task_id' => $this->integer(),
            'employee_id' => $this->integer(),
        ], $this->engine);

        $this->createIndex('unique_case_employee', 'office_tasks_employee_rel', ['task_id','employee_id'], true);
        $this->addForeignKey('fk_task_rel', '{{%office_tasks_employee_rel}}', 'task_id', '{{%office_tasks}}', 'id', 'CASCADE');
        $this->addForeignKey('fk_employee_rel_3', '{{%office_tasks_employee_rel}}', 'employee_id', '{{%office_employee}}', 'id', 'CASCADE');

        /**
         * Документы
         */
        $this->createTable('office_documents', [
            'id' => $this->primaryKey(),
            'account_id' => $this->integer(), // Привязка к аккаунту
            'case_id' => $this->integer(), // Дело
            'client_id' => $this->integer(), // Клиент
            'category' => $this->string(), // Категория. Текущие, Судебный акт, Документы
            'datetime_act' => $this->integer(), // Дата судебного акта
            'category_act' => $this->string(), // Категория акта. Решение, приговор, постановление и т.д.
            'name' => $this->string(), // Наименование
            'file' => $this->string(), // Файл pdf
            'note' => $this->string(), // Примечание
            'court_id' => $this->integer(), // Суд
            'term_appeal' => $this->integer(), // Срок обжалования
            'result' => $this->string(), // Результат
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ], $this->engine);

        $this->createIndex('i_account_id', 'office_documents', 'account_id');
        $this->createIndex('i_client_id', 'office_documents', 'client_id');
        $this->createIndex('i_case_id', 'office_documents', 'case_id');

        /**
         * Заседания
         */
        $this->createTable('office_session', [
            'id' => $this->primaryKey(),
            'account_id' => $this->integer(), // Привязка к аккаунту
            'case_id' => $this->integer(), // Дело
            'client_id' => $this->integer(), // Клиент
            'datetime_act' => $this->integer(), // Дата и время заседания
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ], $this->engine);

        $this->createIndex('i_account_id', 'office_session', 'account_id');
        $this->createIndex('i_client_id', 'office_session', 'client_id');
        $this->createIndex('i_case_id', 'office_session', 'case_id');

        /**
         * Корреспонденция
         */
        $this->createTable('office_correspondence', [
            'id' => $this->primaryKey(),
            'account_id' => $this->integer(), // Привязка к аккаунту
            'case_id' => $this->integer(), // Дело
            'client_id' => $this->integer(), // Клиент
            'employee_id' => $this->integer(), // Сотрудник
            'sender' => $this->string(), // Отправитель
            'recipient' => $this->string(), // Получатель
            'description' => $this->string(), // Краткое содержание
            'mail_number' => $this->string(), // Почтовый идентификатор
            'cost' => $this->integer(), // Сумма
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ], $this->engine);

        $this->createIndex('i_account_id', 'office_correspondence', 'account_id');
        $this->createIndex('i_client_id', 'office_correspondence', 'client_id');
        $this->createIndex('i_case_id', 'office_correspondence', 'case_id');
        $this->createIndex('i_employee_id', 'office_correspondence', 'employee_id');

        /**
         * Доп. примечения
         */
        $this->createTable('office_comments', [
            'id' => $this->primaryKey(),
            'account_id' => $this->integer(), // Привязка к аккаунту
            'task_id' => $this->integer(), // Задача
            'case_id' => $this->integer(), // Дело
            'client_id' => $this->integer(), // Клиент
            'document_id' => $this->integer(), // Документ
            'text' => $this->string(), // Описание
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ], $this->engine);

        $this->createIndex('i_account_id', 'office_comments', 'account_id');
        $this->createIndex('i_task_id', 'office_comments', 'task_id');
        $this->createIndex('i_client_id', 'office_comments', 'client_id');
        $this->createIndex('i_case_id', 'office_comments', 'case_id');
        $this->createIndex('i_document_id', 'office_comments', 'document_id');

        /**
         * Транзацкция по делу
         */
        $this->createTable('office_transaction', [
            'id' => $this->primaryKey(),
            'account_id' => $this->integer(),
            'cost' => $this->integer(), // Сумма
            'type' => $this->string(), // Пополнение, списание
            'note' => $this->string(), // Примечание
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

        $this->createIndex('i_account_id', 'office_transaction', 'account_id');
        $this->createIndex('i_consultation_id', 'office_transaction', 'consultation_id');
        $this->createIndex('i_client_id', 'office_transaction', 'client_id');
        $this->createIndex('i_case_id', 'office_transaction', 'case_id');

        /**
         * Транзацкции по общему счету
         */
        $this->createTable('office_accounting', [
            'id' => $this->primaryKey(),
            'account_id' => $this->integer(),
            'cost' => $this->integer(), // Сумма
            'type' => $this->string(), // Пополнение, списание
            'note' => $this->string(), // Примечание

            // Если списание:
            'target' => $this->string(), // Назначение платежа / Кому

            // Если пополение:
            'transaction_id' => $this->integer(), // Транзакция

            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ], $this->engine);
        $this->createIndex('i_account_id', 'office_accounting', 'account_id');
        $this->createIndex('i_transaction_id', 'office_accounting', 'transaction_id');

        /**
         * Суды
         */
        $this->createTable('office_courts', [
            'id' => $this->primaryKey(),
            'account_id' => $this->integer(), // Привязка к аккаунту
            'name' => $this->string(), // Наименование суда
            'address' => $this->string(), // Адрес
            'phone' => $this->string(), // Телефон
        ], $this->engine);

        $this->createIndex('i_account_id', 'office_courts', 'account_id');

    }

    public function down()
    {
        echo "m200603_100158_office_init cannot be reverted.\n";

        return false;
    }
}
