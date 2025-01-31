data <- read.table("wwwtmp/getSequenceStats", as.is=T)
data[,1] <- as.Date(data[,1], "%Y-%m-%d")
line <-	smooth.spline(data[,1], data[,2], spar=0.7)
data[dim(data)[1],2] <- (data[dim(data)[1],2]/as.numeric(strsplit(as.character(Sys.Date()), "-")[[1]][3]))*30
png("wwwtmp/getSequence.png")
plot(data[,2]~data[,1], type="b", pch=19, xlab="Date", ylab="Monthly use", frame.plot="F")
lines(line, col="blue", lwd=2)
dev.off()


