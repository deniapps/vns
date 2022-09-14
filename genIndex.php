<?php
/**
 * genIndex.php用于生成文件夹下的索引文件，README.md (or. index.md)
 * 需要PHP cli
 * 运行cmd: php getIndex.php
 *
 * 也可以整合到deploy.sh
 *
 */

// 定义文件夹，必须在docs路径下

$mainFolder = "demo";
$subFolder = "inner-demo";
$description = "DEMO"; // 用于描述标题

genIndex($mainFolder, $subFolder, $description);

function genIndex($mainFolder, $folder, $description)
{
    $path = "docs/" . $mainFolder . "/" . $folder . "/";
    $mainIndex = "docs/" . $mainFolder . "/README.md";

    $match = $path . "*.md";

    $articles = [];

    foreach (glob($match) as $filename) {
        if (!preg_match("/README\.md/", $filename)) {
            $name = basename($filename);
            $mTime = filemtime($filename);

            $articles[] = [
                "path" => $filename,
                "url" => "/" . $mainFolder . "/" . $folder . "/" . $name,
                "mTime" => $mTime,
            ];

        }
    }

    usort($articles, function ($i1, $i2) {
        return $i2['mTime'] <=> $i1['mTime'];
    });

    foreach ($articles as $i => $article) {
        $content = file_get_contents($article['path']);

        $title = "";
        if (preg_match("/#([^#|\n]+)\n/smi", $content, $m)) {
            $title = trim($m[1]);
        }
        $articles[$i]['title'] = $title;
    }

    $content = genMarkDown($articles, $description, $mainFolder);

    file_put_contents($path . "/README.md", $content);

    $latest = "\n";
    foreach ($articles as $i => $article) {
        if ($i === 5) {
            break;
        }

        $latest .= "- [" . $article['title'] . "](" . $article['url'] . ") <span>- " . date('m/d/Y', $article['mTime']) . "</span>\n";
    }
    $latest .= "\n";

    $mainIndexContent = file_get_contents($mainIndex);
    // print($mainIndexContent);

    $updatedMainIndexContent = preg_replace("/(<!--" . $folder . "START-->).*?(<!--" . $folder . "END-->)/smi", '${1}' . $latest . '${2}', $mainIndexContent);

    file_put_contents($mainIndex, $updatedMainIndexContent);

}

function genMarkDown($articles, $description, $mainFolder)
{
    $content = "---\n";
    // $content .= "sidebar: false\n";
    $content .= "title: " . $description . " - 文章列表\n";
    $content .= "description: " . $description . " - 文章列表\n";
    $content .= "---\n\n";

    $content .= "# " . $description . " - 文章列表\n";
    $content .= "\n";
    // $content .= '<p><a href="/' . $mainFolder . '">Back &#8617;</a></p>';
    // $content .= "\n\n";

    foreach ($articles as $article) {
        $content .= "- [" . $article['title'] . "](" . $article['url'] . ")\n";
        // 如何需要显示文件最后编辑时间，可以参考下面的代码
        // $content .= "- [" . $article['title'] . "](" . $article['url'] . ") <span>- Last Updated: " . date('m/d/Y H:i:s', $article['mTime']) . "</span>\n";
    }

    return $content;
}
