<?php

    require("soc_common.php");
	
	if (isset($_GET["pid"]))
	{		
		// fetch post
		$post = get_post($_GET["pid"]);

		if (!$post || $post["status"] == "DELETED")
			apologize("Nothing here!");
		
		if (isset($_GET["paction"]))
		{
			if (strcasecmp($_GET["paction"], "sub"))
				post_sub($soc);
			elseif (strcasecmp($_GET["paction"], "unsub"))
				post_unsub($soc);
		}
		
		// fetch comments
		$comms = get_comments($post);
		
		render_mult([	"soc_common.php",
						"post.php"
					],
					[	
						"title" => $post["title"]." - ".$soc["soc_name"],
						"post" => $post,
					    "soc" => $soc,
					    "status" => soc_rel($soc),
						"psub" => post_rel($post["post_id"]),
						"comms" => $comms
					]
				);
	}
	else
	{
		redirect("soc.php?soc=".$soc["soc_name"]);
	}

?>