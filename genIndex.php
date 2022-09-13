<?php

genIndex("maggie");
genIndex("nytimes");

function genIndex($folder)
{
    $path = "docs/english/" . $folder . "/";
    $mainIndex = "docs/english/README.md";

    $match = $path . "*.md";

    $articles = [];

    foreach (glob($match) as $filename) {
        if (!preg_match("/README\.md/", $filename)) {
            $name = basename($filename);
            $mTime = filemtime($filename);

            $articles[] = [
                "path" => $filename,
                "url" => "/english/" . $folder . "/" . $name,
                "mTime" => $mTime,
            ];

        }
        // echo "$filename size " . filesize($filename) . " " . filemtime($filename) . "\n";
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

    $description = "";

    // print_r($articles);
    if ($folder === "maggie") {
        $description = "跟Maggie学英语";
    } elseif ($folder === "nytimes") {
        $description = "纽时简报阅读笔记";
    }

    $content = genMarkDown($articles, $description);

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

// $it = new RecursiveTreeIterator(new RecursiveDirectoryIterator($mainPath, RecursiveDirectoryIterator::SKIP_DOTS));

// foreach ($it as $path) {
//     echo $path . "<br>";
// }

function genMarkDown($articles, $description)
{
    $content = "---\n";
    $content .= "sidebar: false\n";
    $content .= "title: " . $description . " - 文章列表\n";
    $content .= "description: " . $description . " - 文章列表\n";
    $content .= "---\n\n";

    $content .= "# " . $description . " - 文章列表\n";
    $content .= "\n";
    $content .= '<p><a href="/english">Back &#8617;</a></p>';
    $content .= "\n\n";

    foreach ($articles as $article) {
        $content .= "- [" . $article['title'] . "](" . $article['url'] . ")\n";
        // $content .= "- [" . $article['title'] . "](" . $article['url'] . ") <span>- Last Updated: " . date('m/d/Y H:i:s', $article['mTime']) . "</span>\n";
    }

    return $content;
}
