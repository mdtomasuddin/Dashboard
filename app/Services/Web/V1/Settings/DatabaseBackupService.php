<?php

namespace App\Services\Web\V1\Settings;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DatabaseBackupService
{
    /**
     * Export the entire database as a SQL dump string.
     *
     * @throws Exception
     */
    public function export(): string
    {
        try {
            $dbName = config('database.connections.mysql.database');
            $sql    = $this->getHeader($dbName);

            $tables = $this->getTables();

            foreach ($tables as $table) {
                $sql .= $this->exportTableStructure($table);
                $sql .= $this->exportTableData($table);
            }

            $sql .= $this->getFooter();

            return $sql;
        } catch (Exception $e) {
            Log::error(self::class . ':export', ['error' => $e->getMessage()]);
            throw $e;
        }
    }

    /**
     * Get the SQL header with metadata.
     */
    private function getHeader(string $dbName): string
    {
        $header  = "-- -------------------------------------------\n";
        $header .= '-- Database Backup: ' . $dbName . "\n";
        $header .= '-- Generated: ' . now()->format('Y-m-d H:i:s') . "\n";
        $header .= "-- -------------------------------------------\n\n";
        $header .= "SET FOREIGN_KEY_CHECKS = 0;\n";
        $header .= "SET SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO';\n";
        $header .= "SET AUTOCOMMIT = 0;\n";
        $header .= "START TRANSACTION;\n\n";

        return $header;
    }

    /**
     * Get the SQL footer.
     */
    private function getFooter(): string
    {
        return "\nSET FOREIGN_KEY_CHECKS = 1;\nCOMMIT;\n-- -------------------------------------------\n-- Backup Complete\n-- -------------------------------------------\n";
    }

    /**
     * Get all table names from the database.
     */
    private function getTables(): array
    {
        $tables = DB::select('SHOW TABLES');
        $dbName = config('database.connections.mysql.database');
        $key    = 'Tables_in_' . $dbName;

        return array_map(fn($table) => $table->$key, $tables);
    }

    /**
     * Export the CREATE TABLE structure.
     */
    private function exportTableStructure(string $table): string
    {
        $sql = "--\n-- Table structure for table `{$table}`\n--\n";
        $sql .= "DROP TABLE IF EXISTS `{$table}`;\n";

        $createTable  = DB::select("SHOW CREATE TABLE `{$table}`");
        $createKey    = 'Create Table';

        $sql .= $createTable[0]->$createKey . ";\n\n";

        return $sql;
    }

    /**
     * Export all data from a table as INSERT statements.
     */
    private function exportTableData(string $table): string
    {
        $rows = DB::table($table)->get();

        if ($rows->isEmpty()) {
            return "-- Table `{$table}` is empty\n\n";
        }

        $columns    = array_keys((array) $rows->first());
        $columns    = array_map(fn($col) => "`{$col}`", $columns);
        $columnList = implode(', ', $columns);

        $pdo = DB::getPdo();

        $sql = "--\n-- Dumping data for table `{$table}`\n--\n";

        $values = [];
        foreach ($rows as $row) {
            $rowData       = (array) $row;
            $escapedValues = array_map(function ($value) use ($pdo) {
                if ($value === null) {
                    return 'NULL';
                }

                return $pdo->quote((string) $value);
            }, $rowData);
            $values[] = '(' . implode(', ', $escapedValues) . ')';
        }

        // Batch insert in chunks of 500 for large tables
        $chunks = array_chunk($values, 500);
        foreach ($chunks as $chunk) {
            $sql .= "INSERT INTO `{$table}` ({$columnList}) VALUES\n";
            $sql .= implode(",\n", $chunk) . ";\n";
        }

        return $sql;
    }
}
