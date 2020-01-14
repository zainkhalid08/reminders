<?php

namespace App\Traits;


trait InteractsWithEnv
{
  /**
   * Created a new env variable with value
   * or modifies the value of an existing
   * Is also capable for dealing with
   * values having spaces in b/w.
   *
   * Note: is compatible with both
   * .env.testing and .env
   *
   * @param array $keyValues pairs
   * @return void
   * 
   * @example $this->setEnv(['ADMIN_NAME' => 'SOME NAME'])
   */
  public function setEnv($keyValues)
  {
    $envFile = app()->environmentFilePath();

    if (config('app.env') == 'testing' && file_exists($envFile.'.testing')) {
        $envFile = $envFile.'.testing';
    } 

    $str = file_get_contents($envFile);

        if (count($keyValues) > 0) {
            foreach ($keyValues as $envKey => $envValue) {

                $str .= "\n"; // In case the searched variable is in the last line without \n
                $keyPosition = strpos($str, "{$envKey}=");
                $endOfLinePosition = strpos($str, "\n", $keyPosition);
                $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);

                // If key does not exist, add it
                if (!$keyPosition || !$endOfLinePosition || !$oldLine) {
                    // for adding quotes if value has spaces in between
                    if (preg_match('/\s/',$envValue)) {
                        $str .= "{$envKey}='{$envValue}'\n";
                    } else {
                        $str .= "{$envKey}={$envValue}\n";
                    }
                } else {
                    // for adding quotes if value has spaces in between
                    if (preg_match('/\s/',$envValue)) {
                        $str = str_replace($oldLine, "{$envKey}='{$envValue}'", $str);
                    } else {
                        $str = str_replace($oldLine, "{$envKey}={$envValue}", $str);
                    }

                }

            }
        }

        $str = substr($str, 0, -1);
        if (!file_put_contents($envFile, $str)) return false;
        return true;        
    }
}
